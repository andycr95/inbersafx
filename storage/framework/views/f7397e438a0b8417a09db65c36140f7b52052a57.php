<style>
    .multi-action {
        display: inline-block;
        position: fixed;
        width: 56px;
        height: 56px;
        margin: 300px 0 0 -28px;
        right: 15px;
        bottom: 60px;
        z-index: 9999999999;
    }

    .multi-action a {
        padding-top: 11px;
        vertical-align: middle;
        text-align: center;
    }

    .action-button {
        position: absolute;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        border: 0;
        outline: 0;
        background: #fd0d61a6;
        font-size: 24px;
        color: white;
        z-index: 2;
        box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.16), 0 2px 5px 0 rgba(0, 0, 0, 0.26);
        transition: all .3s;
    }
    .action-button:hover {
        color: white;
    }
    .action-button:focus {
        color: white;
    }

    .float-btn {
        position: absolute;
        width: 46px;
        height: 46px;
        text-align: center;
        border-radius: 50%;
        border: 0;
        outline: 0;
        font-size: 24px;
        color: white;
        z-index: 2;
        box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.16), 0 2px 5px 0 rgba(0, 0, 0, 0.26);
        transition: all .3s;
    }

    .float-btn:hover {
        color: white;
    }
    .float-btn:focus {
        color: white;
    }

    .telegram {
        background: #0088ccba;
        bottom: 65px;
        right: 4px;
    }
    .whatsapp {
        background: #158701ba;
        bottom: 0px;
        right: 65px;
    }

    .actions {
        position: absolute;
        list-style: none inside none;
        margin: 0 0 0 0;
        padding: 0;
        width: auto;
        float: left;
        background-color: transparent;
        top: 8px;
        left: 8px;
        z-index: 1;
        width: 40px;
        height: 40px;
        border-radius: 50%;

        li {
            position: absolute;
            display: block;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.16), 0 2px 5px 0 rgba(0, 0, 0, 0.26);
            margin: 0;
            background: #212121;
            color: #ffffff;
            transition: all .3s;
            transform: scale(.3);

            &:nth-child(1) {
                background: #ff9800;
            }

            &:nth-child(2) {
                background: #2196F3;
            }

            &:nth-child(3) {
                background: #FFEB3B;
            }

            &:nth-child(4) {
                background: #E91E63;
            }

            &:nth-child(5) {
                background: #4CAF50;
            }

            a {
                background: inherit;
                color: inherit;
                display: block;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                line-height: 40px;
                text-align: center;
            }

            &:active {
                box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19), 0 8px 17px 0 rgba(0, 0, 0, 0.2);
            }
        }
    }

    .action-button {
        &.active {
            box-shadow: 0 17px 50px 0 rgba(0, 0, 0, 0.19), 0 12px 15px 0 rgba(0, 0, 0, 0.24);
        }

        &.active~.actions {

            li {
                transition: all .3s;
                transform: scale(1);

                &:nth-child(1) {
                    margin-top: -56px;
                }

                &:nth-child(2) {
                    margin-top: -104px;
                }

                &:nth-child(3) {
                    margin-top: -152px;
                }

                &:nth-child(4) {
                    margin-top: -200px;
                }

                &:nth-child(5) {
                    margin-top: -248px;
                }
            }
        }
    }

    .action-button span {
        transition: all .3s;
    }

    .action-button {
        &.active:not(.no-rotate) span {
            transform: scale(1.5) rotate(-45deg);
        }
    }
</style>

<?php
    $yourLinks = content('links.content');
?>


<?php /**PATH /home/webesite/binance.webesite.xyz/core/resources/views/theme3/includes/frontend/float_btn.blade.php ENDPATH**/ ?>