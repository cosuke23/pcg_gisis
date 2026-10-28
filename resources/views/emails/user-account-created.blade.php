<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>PCG GISIS Account Created</title>
</head>

<body>

    <h2>Welcome to PCG GISIS</h2>

    <p>Dear {{ $user->name }},</p>

    <p>Your account has been created successfully.</p>

    <table cellpadding="8">

        <tr>
            <td><strong>Employee No.</strong></td>
            <td>{{ $user->employee_no }}</td>
        </tr>

        <tr>
            <td><strong>Email</strong></td>
            <td>{{ $user->email }}</td>
        </tr>

        <tr>
            <td><strong>Password</strong></td>
            <td>{{ $password }}</td>
        </tr>

        <tr>
            <td><strong>Role</strong></td>
            <td>{{ $user->role }}</td>
        </tr>

    </table>

    <p>
        Please log in and change your password after your first login.
    </p>

    <p>
        Regards,<br>
        PCG MEPOIS Administrator
    </p>

</body>

</html>
