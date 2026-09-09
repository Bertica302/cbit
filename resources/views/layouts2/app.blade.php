<html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proyecto cbit</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<style>
    :root {
        --morado: #6a0dad;
        --morado-oscuro: #4a087a; 
        --azul: #1e3a8a; 
        --azul-claro: #3b82f6;
        --blanco: #ffffff; 
    }

    .btn-menu{

        background: var(--azul-claro); 
        color: var(--blanco);  
        padding:10px 20px; 
        font-size: 1.2rem;
        border-radius:10px; 
        transition: 0.25s ease; 
        border:none;  
        min-width:100%; 
    } 

    .btn-menu:hover {
        background: var(--morado-oscuro); 
        transform:translateY(-3px);
    }

    .btn-menu-secondary{
        background: var(--azul); 
        color:var(--blanco); 
        padding:18px 24px;
        font-size: 1.2rem;
        border-radius:12px;
        transition: 0.25s ease; 
        border:none; 
        width:100%; 
    }

    .btn-menu-secondary:hover{
        background:var(--azul-claro);
        transform: translateY(-3px);
    }

    .body
    {
background: linear-grdaient(135deg, var(--morado) 0%, var(--azul) 1000%); 
min-height: 100vh;  
    }

    .menu-container
    {
        background:rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(6px); 
        padding:30px;
        border-radius:15px; 
    }
</style>

</head>
<body>
  
    <header> </header>

@yield('content')  

    <footer></footer>
</body>
</html>