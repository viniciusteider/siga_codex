<?php
class Here
{
    public function BuscarEndereco($end)
    {
            $url = "https://geocoder.ls.hereapi.com/6.2/geocode.json?apiKey=".HERE_KEY;

           echo $linkPesquisa = $url."&searchtext=".str_replace(" ", "%20", $end);

            $curl = curl_init($linkPesquisa);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_USERAGENT , 'Codular Sample cURL Request');

            $json_response = curl_exec($curl);
            $json_response =  json_decode($json_response, true);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            curl_close($curl);
            $json_response['status'] = $status;
            return $json_response;
    }
}