<html>
<head>
    <title>Intercambio - Envio de DTEs</title>
    <style type="text/css">
        div.page {
            margin: 0 10px;
            padding: 0;
            width: 640px;
        }

        div.left {
            margin: 0;
            padding: 0 20px 0 0;
            width: 300px;
            float: left;
        }

        div.right {
            margin: 0;
            padding: 0 0 0 20px;
            width: 300px;
            float: right;
        }

        div.both {
            margin: 0;
            padding: 0;
            clear: both;
        }

        div.footer {
            margin: 0;
            padding: 10px 0;
        }

        p.copyright {
            text-align: center;
            font-size: 9px;
        }
        body {
            font-family: Geneva, Verdana, sans-serif;
            font-size: 11px;
            color: #000;
            background-color: #fff;
        }

        h1 {
            margin: 0;
            padding: 5px 0;
            font-size: 15px;
            color: #999;
            border-bottom: 1px solid #999;
        }

        h2 {
            margin: 0;
            padding: 10px 0 5px;
            font-size: 13px;
        }

        p {
            margin: 0;
            padding: 1px 0;
        }

        table {
            margin: 0;
            padding: 0;
            width: 100%;
            text-align: right;
            border-top: 1px solid #999;
            border-bottom: 1px solid #999;
        }

        th {
            margin: 0;
            padding: 3px 5px;
            border-bottom: 1px solid #999;
            font-size: 11px;
        }

        td {
            margin: 0;
            padding: 2px 5px;
            vertical-align: top;
            font-size: 11px;
        }

        td.rut {
            white-space: nowrap;
        }
    </style>
</head>
<body>
<div class="page">
    <h1>Producci&oacute;n
        &middot; Intercambio &middot; Env&iacute;o de DTEs</h1>

    <div class="left">
        <h2>Emisor</h2>
        <p>{{$post['company']['company_name']}}</p>
        <p>{{$post['company']['rut']}}</p>
    </div>
    <div class="right">
        <h2>Receptor</h2>
        <p>{{$post['client']['company_name']}}</p>
        <p>{{$post['client']['rut']}}</p>
    </div>

    <div class="both">
        <h2>Detalle</h2>

        <table cellspacing="0" cellpadding="5">
            <tr>
                <th>Emisor</th>
                <th>Tipo</th>
                <th>Folio</th>
                <th>Fecha</th>
                <th>Monto</th>
            </tr>
            <tr>
                <td class="rut" style="text-align: right;">{{$post['company']['rut']}}</td>
                <td style="text-align: right;">{{$post['document']['type']}}</td>
                <td style="text-align: right;">{{$post['document']['document_number']}}</td>
                <td style="text-align: right;">{{$post['document']['emited_at']}}</td>
                <td style="text-align: right;">{{$post['document']['total']}}</td>
            </tr>

        </table>
    </div>

    <div class="footer">
        <h3><strong>Descargar PDF <a href="{{'https://s3-sa-east-1.amazonaws.com/agroterra/pdf/DTE_F'.$post['document']['document_number'].'T'.$post['document']['type'].'.pdf'}}">Documento Folio {{$post['document']['document_number']}}.pdf</a></strong></h3>
        <p>Este correo adjunta Documentos Tributarios Electr&oacute;nicos (DTE)
            para el receptor electr&oacute;nico
            indicado. Por favor responda con un acuse de recibo (RespuestaDTE)
            conforme al modelo de intercambio de
            Factura Electr&oacute;nica del SII.</p>

        <br/>

        <p class="copyright">
            Servicios de Facturaci&oacute;n Electr&oacute;nica de <a  href="http://sizesoft.cl">Sizesoft.cl</a>
        </p>
    </div>
</div>
</body>
</html>