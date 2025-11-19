<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HabingIbaan - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: 'rgb(194, 65, 12)',
                        'primary-dark': 'rgb(154, 52, 10)',
                        'primary-light': 'rgb(234, 88, 12)'
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:100i,300,400,500,600,700,800,900" rel="stylesheet" />
    <style>
        *{
            font-family: 'Poppins';
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- DataTables Tailwind CSS -->
    <!-- Tailwind CSS (your own app.css already has it via Vite) -->

<!-- DataTables 2 + Tailwind -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css" />
  
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>

</head>
<body class="bg-gray-50">