<?php

namespace Deployer;

require 'recipe/common.php';

set('application', 'samu');
set('repository', 'git@github.com:Segeagle/samu.git');
host('185.238.230.30')
    ->set('remote_user', 'root')
    ->set('deploy_path', '/var/www/html/samu');

set('git_tty', false);
set('ssh_multiplexing', false);
add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

task('build', function () {
    run('cd {{release_path}} && build');
});
after('deploy:failed', 'deploy:unlock');


task('deploy:msg', function(){
    writeln("ATUALIZANDO PRODUÇÃO SAMU");
});

task('deploy:link_upload', function () {
    run('cd {{release_path}} && ln -s /var/www/html/samu/shared/upload upload');
});

task('deploy:link_config', function () {
    run('cd {{release_path}}/includes && ln -s /var/www/html/samu/shared/config config');
});


task('deploy', [
    'deploy:msg',
    'deploy:prepare',
    'deploy:update_code',
    'deploy:vendors',
    'deploy:symlink', 
    'deploy:link_upload',  
    'deploy:link_config',  
    'deploy:unlock',
    'deploy:cleanup',
    'deploy:success'
]);
