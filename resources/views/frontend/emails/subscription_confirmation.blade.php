<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Bienvenido a Eventos Especiales Lerma!</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Raleway:wght@300;400;600&display=swap');
        
        body {
            font-family: 'Raleway', sans-serif;
            line-height: 1.6;
            color: #4b8b97;
            margin: 0;
            padding: 0;
            background-color: #f9f5f2;
            -webkit-font-smoothing: antialiased;
        }
        
        .email-container {
            max-width: 620px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            padding: 40px 0 30px;
            background: linear-gradient(135deg, #f5ddd5 0%, #f8ccbf 100%);
            border-radius: 12px 12px 0 0;
            margin-bottom: -20px;
        }
        
        .logo {
            max-width: 200px;
            height: auto;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }
        
        .content {
            background-color: #ffffff;
            padding: 50px 40px 40px;
            border-radius: 0 0 12px 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 1;
            border: 1px solid #f0e6e0;
            border-top: none;
        }
        
        h1 {
            font-family: 'Playfair Display', serif;
            color: #4b8b97;
            font-size: 28px;
            margin-top: 0;
            margin-bottom: 30px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        
        p {
            margin-bottom: 20px;
            font-size: 16px;
            color: #5a5a5a;
            line-height: 1.7;
        }
        
        .details {
            background-color: #fff9f7;
            padding: 25px;
            border-radius: 8px;
            margin: 30px 0;
            border-left: 4px solid #F6BBA9;
            box-shadow: inset 0 0 0 1px rgba(240, 185, 160, 0.3);
        }
        
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 13px;
            color: #a8a8a8;
            padding: 25px 0;
        }
        
        .signature {
            margin-top: 40px;
            position: relative;
        }
        
        .signature:before {
            content: "";
            display: block;
            width: 100px;
            height: 2px;
            background: linear-gradient(90deg, #4b8b97, transparent);
            margin-bottom: 25px;
        }
        
        .signature p {
            margin-bottom: 8px;
        }
        
        .signature-name {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            color: #2a4044;
            font-weight: 700;
            margin-bottom: 5px !important;
        }
        
        .social-links {
            margin: 35px 0 25px;
            text-align: center;
        }
        
        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            margin: 0 6px;
            transition: all 0.3s ease;
        }
        
        .social-link img {
            width: 18px;
            height: 18px;
        }
        
        .btn-container {
            text-align: center;
            margin: 35px 0;
        }
        
        .btn {
            display: inline-block;
            padding: 14px 32px;
            background-color: #F6BBA9;
            color: #ffffff;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(246, 187, 169, 0.4);
        }

        a.btn {
            color: #ffffff;
            text-decoration: none !important;
        }
        
        .btn:hover {
            background-color: #f8a58f;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(246, 187, 169, 0.5);
        }
    
        @media only screen and (max-width: 600px) {
            .content {
                padding: 35px 25px;
            }
            
            h1 {
                font-size: 24px;
            }
            
            .header {
                padding: 30px 0 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="https://i.ibb.co/819cBhY/Logo.png" alt="Eventos Especiales Lerma" class="logo">
        </div>
        
        <div class="content">
            <h1>¡Gracias por suscribirte!</h1>
            
            <p>Estamos encantados de tenerte como parte de nuestra comunidad en Eventos Especiales Lerma.</p>
            
            <div class="details">
                <p>A partir de ahora recibirás en tu correo electrónico <strong>{{ $email }}</strong> nuestras mejores promociones, descuentos exclusivos y novedades sobre nuestros servicios.</p>
                
                <p>Nuestros boletines incluyen:</p>
                <ul style="margin-left: 20px; list-style-type: disc; color: #5a5a5a;">
                    <li>Ofertas especiales para suscriptores</li>
                    <li>Nuevos servicios y paquetes</li>
                    <li>Historias de eventos realizados</li>
                    <li>Consejos para organizar tu evento perfecto</li>
                </ul>
            </div>
            
            <p>Si en algún momento deseas dejar de recibir nuestros correos, simplemente responde a este mensaje con el asunto "Cancelar suscripción" y lo procesaremos inmediatamente.</p>
            
            <div class="btn-container">
                <a href="{{ route('welcome') }}" class="btn">Visitar nuestro sitio web</a>
            </div>
            
            <div class="social-links">
                <a href="https://www.facebook.com/eventosespecialeslerma1/" class="social-link" target="_blank" rel="noopener noreferrer">
                    <img src="https://cdn-icons-png.flaticon.com/512/124/124010.png" alt="Facebook">
                </a>
                <a href="https://www.instagram.com/eventosespeciales.lerma/" class="social-link" target="_blank" rel="noopener noreferrer">
                    <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram">
                </a>
            </div>
            
            <div class="signature">
                <p>Saludos,</p>
                <p class="signature-name">Eventos Especiales Lerma</p>
                <p style="margin-bottom: 5px;"><span style="color: #4b8b97;">✆</span> 728 284 9074</p>
                <p><span style="color: #4b8b97;">✉</span> info@eventosespecialeslerma.com</p>
            </div>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} Eventos Especiales Lerma. Todos los derechos reservados.</p>
            <p style="margin-top: 8px; font-size: 12px;">
                <a href="#" style="color: #b8b8b8; text-decoration: none; transition: color 0.3s;">Política de Privacidad</a> 
                <span style="color: #e0e0e0; margin: 0 8px;">|</span> 
                <a href="#" style="color: #b8b8b8; text-decoration: none; transition: color 0.3s;">Términos de Servicio</a>
            </p>
        </div>
    </div>
</body>
</html>