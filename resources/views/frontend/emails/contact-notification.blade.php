<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gracias por contactarnos</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        
        .content {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            color: #0e7490;
            font-size: 24px;
            margin-bottom: 20px;
        }
        
        p {
            margin-bottom: 15px;
        }
        
        .details {
            background-color: #f0fdfa;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #0d9488;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0d9488;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <!-- Reemplaza con tu logo -->
        <img src="{{ asset('images/logo.png') }}" alt="Eventos Especiales Lerma" class="logo">
    </div>
    
    <div class="content">
        <h1>¡Gracias por contactarnos, {{ $contactData['name'] }}!</h1>
        
        <p>Hemos recibido tu mensaje y nos pondremos en contacto contigo lo antes posible.</p>
        
        <div class="details">
            <p><strong>Detalles de tu mensaje:</strong></p>
            <p><strong>Asunto:</strong> {{ $contactData['subject'] ?? 'No especificado' }}</p>
            <p><strong>Mensaje:</strong> {{ $contactData['message'] }}</p>
        </div>
        
        <p>Si necesitas cualquier otra información, no dudes en responder a este correo.</p>
        
        <p>Atentamente,</p>
        <p><strong>Equipo de Eventos Especiales Lerma</strong></p>
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} Eventos Especiales Lerma. Todos los derechos reservados.</p>
    </div>
</body>
</html>