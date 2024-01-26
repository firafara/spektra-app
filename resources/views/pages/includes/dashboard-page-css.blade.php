@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.css">
    <link href="{{ asset('/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <style>
        .button {
            border-radius: 4px;
            background-color: #9d9d9c;
            border: none;
            color: #FFFFFF;
            text-align: center;
            font-size: 24px;
            padding: 10px;
            width: 350px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .button span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.3s;
        }

        .button span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            transition: 0.5s;
        }

        .button:hover span {
            padding-right: 105px;
        }

        .button:hover span:after {
            opacity: 1;
            right: 0;
        }

        .button-new {
            position: absolute;
            padding: 2px 12px 2px 12px;
            font-size: 10px;
            text-align: center;
            cursor: pointer;
            outline: none;
            background-color: #ff8000;
            border: none;
            border-radius: 15px;
            box-shadow: 0 3px #999;
            margin-left: 10px;
            color: white;
        }

        .button-new:hover {
            background-color: #ab9c12;
            text-decoration: none;
        }

        .button-new:active {
            background-color: #ff8000;
            box-shadow: 0 3px #666;
            transform: translateY(4px);
        }

        .link {
            color: white;
        }

        .link:hover {
            text-decoration: none;
            color: #ff8000;
        }
    </style>
@endpush
