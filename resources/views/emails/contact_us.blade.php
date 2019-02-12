<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>


<body>
    <table width="100%" cellpadding="0" cellspacing="0" align="center">
        <tr>
            <td>
                <h1>Contact Us Submission</h1>
            </td>
        </tr>
        <tr>
            <td>
                <table width="540px" cellpadding="0" cellspacing="0">
                    <tr>
                        <td> <strong>Full Name<strong> </td>
                        <td> {{ $contactUs->full_name }} </td>
                    </tr>
                    <tr>
                        <td> <strong>Email</strong> </td>
                        <td> {{ $contactUs->email }} </td>
                    </tr>
                    <tr>
                        <td> <strong>Phone</strong> </td>
                        <td> {{ $contactUs->phone }} </td>
                    </tr>
                    <tr>
                        <td colspan="2"> <strong>Message</strong> </td>
                    </tr>
                    <tr>
                        <td colspan="2"> {!! nl2br(e($contactUs->message)) !!} </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>



