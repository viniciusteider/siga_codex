<!--begin::User menu-->
<div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
    <!--begin::Menu wrapper-->
    <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
        <img src="<?= $_SESSION['usuario']['foto'];?>" alt="user" />
    </div>
    <!--begin::User account menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <div class="menu-content d-flex align-items-center px-3">
                <!--begin::Avatar-->

                <div class="symbol symbol-50px me-5">
                    <img alt="Logo" src="<?= $_SESSION['usuario']['foto'];?>" />
                </div>
                <!--end::Avatar-->
                <!--begin::Username-->
                <div class="d-flex flex-column">
                    <div class="fw-bold d-flex align-items-center fs-5"><?=$_SESSION['usuario']['nome'];?>
                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2"><?=($_SESSION['usuario']['nome_tipo'] != "") ? $_SESSION['usuario']['nome_tipo'] : 'Administrador';?></span></div>
                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7"><?=$_SESSION['usuario']['nome_grupo'];?></a>
                </div>
                <!--end::Username-->
            </div>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu separator-->
        <div class="separator my-2"></div>
        <!--end::Menu separator-->
        <!--begin::Menu item-->
        <div class="menu-item px-5">
            <a href="#index_xml.php?app_modulo=usuario&app_comando=frm_atualizar_meus_dados&tipo_listagem=3" class="menu-link px-5">Meus Dados</a>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu item-->
        <div class="menu-item px-5">
            <a href="#index_xml.php?app_modulo=home&app_comando=sair" class="menu-link px-5">Sair</a>
        </div>
        <!--end::Menu item-->

    </div>
    <!--end::User account menu-->
    <!--end::Menu wrapper-->
</div>
<!--end::User menu-->