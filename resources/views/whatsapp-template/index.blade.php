<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>WATI-Style WhatsApp Template</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body class="bg-light p-4">
    <div class="container bg-white p-4 rounded shadow">
        <div>
            <a href="{{ url('whatsapTemplate/create') }}" class="btn btn-primary" target="_blank">+ Add New Template</a>
        </div>
        <br>
        <h4>WhatsApp Template List</h4>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Template Name</th>
                <th scope="col">Category</th>
                <th scope="col">Language</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($templates as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->template_name }}</td>
                    <td>{{ $item->category }}</td>
                    <td>{{ isset($language[$item->language]) ? $language[$item->language] : '' }}</td>
                    <td>-</td>
                    <td>
                        <a href="{{ route('whatsappTemplate.show', $item->id) }}" class="btn btn-primary" target="_blank">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
