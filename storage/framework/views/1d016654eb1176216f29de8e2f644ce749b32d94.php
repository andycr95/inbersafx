<style>
    /* Loader-section */
    #loader {
        position: fixed;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 99999;
        background: #64b5f6;
        background-image: linear-gradient(to bottom, #1976d2 0, #64b5f6 100%) !important;
        display: flex;
        align-items: center;
        justify-content: center;
        user-select: none;
    }

    .dashboard-main {
        min-height: 100vh;
        background-color: #e5eaf000;
        background: linear-gradient(180deg, rgba(255, 57, 111, 1) 0%, rgba(255, 116, 154, 1) 9%, rgba(229, 234, 240, 1) 35%);
        background-attachment: fixed;
    }

    /* background: linear-gradient(180deg, rgba(255,57,111,1) 0%, rgba(255,116,154,1) 6%, rgba(229,234,240,1) 30%); */

    /* card-section */
    .card-block .card-main {
        background-image: linear-gradient(-180deg, rgba(0, 0, 0, 0) 0%, rgb(0 0 0 / 8%) 100%);
    }

    /* link-section */
    .section-heading .link {
        color: rgb(255 54 147 / 50%);
    }

    .select {
        height: 35px;
        padding: 0px 5px;
    }



    /* sidebar-section */

    .sidebar-balance {
        background: #1b1b27 !important;
    }

    .action-group {
        background: #262930;
    }

    /* header-section */
    .wallet-card-section:before {
        /* background-image: linear-gradient(to bottom,#ff749a 0,#e5eaf0 100%) !important; */
        background-image: linear-gradient(to bottom, #ff749900 0, #e5eaf000 100%) !important;
        background: #6236ff00;
        height: 200px;
        border-radius: 0px 0px 20px 20px;
    }

    /* gateway-section */
    .gatewayItem {
        padding: 3px;
        border-radius: 11px;
        border: 1px solid #dee2e6;
        cursor: pointer;
    }

    .gatewayActive {
        border: 2px solid #ffc107 !important;
    }

    .gatewayItem img {
        max-width: 110px;
        width: 100%;
        transition: transform .2s;
    }

    .gatewayItem img:hover {
        transform: scale(1.1);
    }

    /* input-group */
    .after-append {
        background: #8494A8;
        color: #FFF;
        padding: 10px;
        border-radius: 0 8px 8px 0px !important;
    }

    .before-append {
        background: #8494A8;
        color: #FFF;
        padding: 10px;
        border-radius: 8px 0 0 8px !important;
    }

    .input-group>:not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
        margin-left: -1px;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        height: auto;
    }



    /* Icon-cestion */
    .wallet-card .wallet-footer .item .icon-wrapper {
        border-radius: 50%;
    }

    .custom-icon-box {
        background: #6236FF;
        width: 48px;
        height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: #fff;
        font-size: 24px;
    }

    .stat-box {
        background: #ffffff;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.09);
        border-radius: 10px;
        padding: 10px 15px;
        height: 100%;
    }

    /* background-section */

    /* gradiant */
    .gr-bg-blue {
        background-image: linear-gradient(to right, #1976d2 0, #64b5f6 100%) !important;
    }

    .gr-bg-red {
        background-image: linear-gradient(45deg, #f93a5a, #f7778c) !important;
    }

    .gr-bg-green {
        background-image: linear-gradient(to left, #48d6a8 0%, #029666 100%) !important;
    }

    .gr-bg-orange {
        background-image: linear-gradient(to left, #efa65f, #f76a2d) !important;
    }

    .bg-primary {
        background-image: #1E2329;
        color: #FFF;
    }

    /* .bg-primary {
        background-image: linear-gradient(to bottom,#ff396f 0,#f664b8 100%) !important;
        color: #FFF;
    } */
    .bg-pink-light {
        background-image: linear-gradient(to bottom, #ff396f 0, #ffc6e7 100%) !important;
        color: #FFF;
    }

    .bg-pink-light-alt {
        background-image: linear-gradient(to top, #ff396f 0, #ffc6e7 100%) !important;
        color: #FFF;
    }

    /* button-section */
    .btn {
        border-radius: 30px;
    }

    .btn-text-primary {
        color: #ff396f !important;
    }

    .modal button.close {
        width: 30px;
        height: 30px;
        background-color: #f63d43;
        color: #fff;
        opacity: 1;
        padding: 0;
        border-radius: 50%;
    }

    .btn-primary {
        background-image: linear-gradient(to bottom, #1976d2 0, #64b5f6 100%) !important;
        border-color: #1976d2 !important;
        color: #FFFFFF !important;
    }

    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:active,
    .btn-primary.active {
        background-image: linear-gradient(to top, #1976d2 0, #64b5f6 100%) !important;
        border-color: #64b5f6 !important;
    }

    .btn-primary.disabled,
    .btn-primary:disabled {
        background-image: linear-gradient(to bottom, #1976d2 0, #64b5f6 100%);
        border-color: #1976d2;
        opacity: 0.5;
    }

    .btn-secondary {
        background-image: linear-gradient(to bottom, #8494A8 0, #e0edff 100%) !important;
        border: 0px;
        color: #FFFFFF !important;
    }

    .btn-secondary:hover {
        background-image: linear-gradient(to top, #8494A8 0, #e0edff 100%) !important;
        border: 0px;
        color: #FFFFFF !important;
    }

    .btn-secondary:focus {
        background-image: linear-gradient(to top, #8494A8 0, #e0edff 100%) !important;
        border: 0px;
        color: #FFFFFF !important;
    }

    .btn-pink-light {
        background-image: linear-gradient(to bottom, #ff396f 0, #ffc6e7 100%) !important;
        color: #FFF;
        border: 0px;
    }

    .btn-pink-light:hover {
        background-image: linear-gradient(to top, #ff396f 0, #ffc6e7 100%) !important;
        color: #FFF;
        border: 0px;
    }

    .btn-pink-light:focus {
        background-image: linear-gradient(to top, #ff396f 0, #ffc6e7 100%) !important;
        color: #FFF;
        border: 0px;
    }

    .main-btn {
        background-image: linear-gradient(to bottom, #ff396f 0, #ffc6e7 100%) !important;
        color: #FFF;
        border: 0px;
    }

    .main-btn:hover {
        background-image: linear-gradient(to top, #ff396f 0, #ffc6e7 100%) !important;
        color: #FFF;
        border: 0px;
    }

    .main-btn:focus {
        background-image: linear-gradient(to top, #ff396f 0, #ffc6e7 100%) !important;
        color: #FFF;
        border: 0px;
    }

    .modal button.close {
        background-image: linear-gradient(to top, #fd0000 0, #ffe8e8 100%) !important;
        border: 0px !important;
    }

    /* badge-section */

    .badge-primary::before {
        background-color: #ffffff00;
    }

    .badge-info::before {
        background-color: #ffffff00;
    }

    .badge-warning::before {
        background-color: #ffffff00;
    }

    .badge-danger::before {
        background-color: #ffffff00;
    }

    .badge-success::before {
        background-color: #ffffff00;
    }


    /* font-cection */
    .stat-box .value {
        font-size: 15px;
    }

    .stat-box .title {
        font-size: 12px;
    }

    .small-font {
        color: #333;
        font-size: 10px;
        text-align: center;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    .small-font-sm {
        color: #333;
        font-size: 8px;
        text-align: center;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    .small-font-lg {
        color: #333;
        font-size: 12px;
        text-align: center;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    .text-pink,
    a.text-pink {
        color: #ff396f !important;
    }

    /* reffer-cection */
    .sp-referral .single-child {
        padding: 6px 10px;
        border-radius: 5px;
    }

    .sp-referral .single-child+.single-child {
        margin-top: 15px;
    }

    .sp-referral .single-child p {
        display: flex;
        align-items: center;
        margin-bottom: 0;
    }

    .sp-referral .single-child p img {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        object-fit: cover;
        -o-object-fit: cover;
    }

    .sp-referral .single-child p span {
        width: calc(100% - 35px);
        font-size: 14px;
        padding-left: 10px;
    }

    .sp-referral>.single-child.root-child>p img {
        border: 2px solid #c3c3c3;
    }

    .sub-child-list {
        position: relative;
        padding-left: 35px;
    }

    .sub-child-list::before {
        position: absolute;
        content: '';
        top: 0;
        left: 17px;
        width: 1px;
        height: 100%;
        background-color: #a1a1a1;
    }

    .sub-child-list>.single-child {
        position: relative;
    }

    .sub-child-list>.single-child::before {
        position: absolute;
        content: '';
        left: -18px;
        top: 21px;
        width: 30px;
        height: 5px;
        border-left: 1px solid #a1a1a1;
        border-bottom: 1px solid #a1a1a1;
        border-radius: 0 0 0 5px;
    }

    .sub-child-list>.single-child>p img {
        border: 2px solid #c3c3c3;
    }

    /* border-section */
    .card {
        border-radius: 20px !important;
    }

    .rounded-20px {
        border-radius: 20px !important;
    }

    .border-tl-50 {
        border-radius: 70px 20px 20px 20px !important;
    }

    .border-tl-60 {
        border-radius: 70px 20px 20px !important;
    }

    .border-tl-70 {
        border-radius: 70px 20px 20px 20px !important;
    }

    .image-listview > li .item {
        padding: 3px 11px;
        min-height: 45px;
    }

    /****************/
    /* admin-section
    /****************/

</style>

<style>
    body, .appHeader, .appBottomMenu {
        max-width: 500px;
        margin: auto;
    }
    .spin-now {
        animation-name: spin;
        animation-duration: 4000ms;
        animation-iteration-count: infinite;
        animation-timing-function: linear;
    }

    @keyframes  spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }
</style>
<?php /**PATH /home/crevitoc/Crevito/script.crevito.com/binancetrade/core/resources/views/theme3/layout/custom/css.blade.php ENDPATH**/ ?>