@push('js')
<script>
    // ====== CONFIGURACIÓN ======
    let cempasuchil_cantidad = 26;      // flores completas
    let petalos_cantidad    = 45;       // pétalos sueltos
    let cempasuchil_velocidad = 0.35;   // ← más lento (antes 0.8)
    let cempasuchil_cantidadsize = 34;  // tamaño máximo flor (más pequeño)
    let cempasuchil_chico = 18;         // tamaño mínimo flor
    let cempasuchil_zona = 1;

    let cempasuchil_colores = [
        "#FF8C00","#FFA500","#FFB347","#FFD700",
        "#FFC300","#FF7A1A","#E67E22","#F39C12"
    ];
    let petalos_colores = ["#FFB347","#FFD700","#FFC300","#FFA500","#FF8C00"];

    let cempasuchil = [];
    let petalos = [];
    let marginbottom, marginright;

    function aleatorio(r){ return Math.floor(r * Math.random()); }
    function aleatorioFloat(min,max){ return Math.random()*(max-min)+min; }

    // ====== SVG FLOR REALISTA ======
    function crearFlorCempasuchil(colorExt, colorInt, tamaño){
        let id = "g" + Math.random().toString(36).slice(2,8);
        let numExt = 16, numInt = 12;
        let petalosExt = "", petalosInt = "";

        // Capa exterior: pétalos largos con degradado
        for (let p = 0; p < numExt; p++){
            let a = (360 / numExt) * p;
            petalosExt += `<ellipse cx="50" cy="19" rx="7.5" ry="21"
                fill="url(#${id}ext)" opacity="0.95"
                transform="rotate(${a} 50 50)" />`;
        }
        // Capa interior: pétalos cortos, girados, más saturados
        for (let p = 0; p < numInt; p++){
            let a = (360 / numInt) * p + (360 / numInt) / 2;
            petalosInt += `<ellipse cx="50" cy="25" rx="6" ry="15"
                fill="${colorInt}" opacity="0.98"
                transform="rotate(${a} 50 50)" />`;
        }

        // Centro con semillas
        let centro = `
            <radialGradient id="${id}c" cx="50%" cy="50%" r="50%">
                <stop offset="0%" stop-color="#FFD27A"/>
                <stop offset="55%" stop-color="#E67E22"/>
                <stop offset="100%" stop-color="#8C2E00"/>
            </radialGradient>
            <circle cx="50" cy="50" r="14" fill="url(#${id}c)"/>
            <circle cx="46" cy="46" r="1.6" fill="#4A1A00" opacity="0.85"/>
            <circle cx="54" cy="46" r="1.6" fill="#4A1A00" opacity="0.85"/>
            <circle cx="50" cy="54" r="1.6" fill="#4A1A00" opacity="0.85"/>
            <circle cx="45" cy="52" r="1.4" fill="#4A1A00" opacity="0.85"/>
            <circle cx="55" cy="52" r="1.4" fill="#4A1A00" opacity="0.85"/>
            <circle cx="50" cy="50" r="1.4" fill="#4A1A00" opacity="0.85"/>
            <circle cx="47.5" cy="49" r="1.2" fill="#4A1A00" opacity="0.85"/>
            <circle cx="52.5" cy="49" r="1.2" fill="#4A1A00" opacity="0.85"/>
        `;

        return `<svg xmlns="http://www.w3.org/2000/svg" width="${tamaño}" height="${tamaño}" viewBox="0 0 100 100">
            <defs>
                <radialGradient id="${id}ext" cx="50%" cy="50%" r="55%">
                    <stop offset="0%" stop-color="${colorExt}"/>
                    <stop offset="70%" stop-color="${colorExt}"/>
                    <stop offset="100%" stop-color="#FFE28A"/>
                </radialGradient>
            </defs>
            <g>${petalosExt}${petalosInt}${centro}</g>
        </svg>`;
    }

    // ====== SVG PÉTALO SUELTO ======
    function crearPetalo(color, tamaño){
        let id = "p" + Math.random().toString(36).slice(2,8);
        return `<svg xmlns="http://www.w3.org/2000/svg" width="${tamaño}" height="${tamaño*1.5}" viewBox="0 0 40 60">
            <defs>
                <radialGradient id="${id}" cx="50%" cy="35%" r="65%">
                    <stop offset="0%" stop-color="#FFE28A"/>
                    <stop offset="55%" stop-color="${color}"/>
                    <stop offset="100%" stop-color="${color}"/>
                </radialGradient>
            </defs>
            <ellipse cx="20" cy="30" rx="8.5" ry="21" fill="url(#${id})" opacity="0.95"/>
            <ellipse cx="20" cy="26" rx="3" ry="12" fill="#FFE28A" opacity="0.35"/>
        </svg>`;
    }

    // ====== CREAR ELEMENTO CON FADE-IN ======
    function crearElementoFlotante(tipo, i){
        let esFlor = (tipo === "flor");
        let tamaño = esFlor
            ? aleatorio(cempasuchil_cantidadsize - cempasuchil_chico) + cempasuchil_chico
            : aleatorioFloat(10, 18);

        let color1, color2;
        if (esFlor){
            color1 = cempasuchil_colores[aleatorio(cempasuchil_colores.length)];
            color2 = cempasuchil_colores[aleatorio(cempasuchil_colores.length)];
        } else {
            color1 = petalos_colores[aleatorio(petalos_colores.length)];
        }

        let div = document.createElement("div");
        div.style.position = "absolute";
        div.style.width = tamaño + "px";
        div.style.height = (esFlor ? tamaño : tamaño * 1.5) + "px";
        div.style.pointerEvents = "none";
        div.style.willChange = "transform, top, left, opacity";
        div.style.opacity = "0";
        div.style.transition = "opacity 1.2s ease-out";
        div.style.filter = "drop-shadow(0 0 4px rgba(255,150,50,0.45))";
        div.innerHTML = esFlor
            ? crearFlorCempasuchil(color1, color2, tamaño)
            : crearPetalo(color1, tamaño);
        document.body.appendChild(div);

        // Fade-in tras un pequeño delay
        requestAnimationFrame(() => { div.style.opacity = "1"; });

        return {
            el: div,
            tamaño,
            esFlor,
            posx: aleatorio(marginright - tamaño),
            posy: -tamaño - aleatorio(marginbottom),  // arriba del todo
            sink: (cempasuchil_velocidad * tamaño) / (esFlor ? 7 : 8),
            balanceoAmp: aleatorioFloat(esFlor ? 8 : 14, esFlor ? 18 : 28),
            balanceoFreq: aleatorioFloat(0.012, 0.028),
            fase: Math.random() * Math.PI * 2,
            rot: Math.random() * 360,
            velRot: (Math.random() - 0.5) * (esFlor ? 1.6 : 3.2)
        };
    }

    // ====== INICIALIZACIÓN ======
    function initCempasuchil(){
        marginbottom = Math.max(document.body.scrollHeight, document.documentElement.scrollHeight);
        marginright  = Math.max(document.body.clientWidth,  document.documentElement.clientWidth);

        for (let i = 0; i < cempasuchil_cantidad; i++) cempasuchil.push(crearElementoFlotante("flor", i));
        for (let i = 0; i < petalos_cantidad;    i++) petalos.push(crearElementoFlotante("petalo", i));

        requestAnimationFrame(moverCempasuchil);
    }

    // ====== ANIMACIÓN ======
    function moverCempasuchil(){
        // Flores
        for (let i = 0; i < cempasuchil.length; i++){
            let f = cempasuchil[i];
            f.posy += f.sink;
            f.fase += f.balanceoFreq;
            let x = f.posx + Math.sin(f.fase) * f.balanceoAmp;
            f.rot += f.velRot;

            // Fade-out cerca del fondo
            let distFondo = marginbottom - f.posy;
            if (distFondo < 120) f.el.style.opacity = Math.max(0, distFondo / 120).toFixed(2);

            f.el.style.left = x + "px";
            f.el.style.top  = f.posy + "px";
            f.el.style.transform = `rotate(${f.rot}deg)`;

            // Reinicio SIEMPRE por arriba
            if (f.posy > marginbottom + f.tamaño){
                f.posy = -f.tamaño - aleatorio(250);
                f.posx = aleatorio(marginright - f.tamaño);
                f.fase = Math.random() * Math.PI * 2;
                f.rot  = Math.random() * 360;
                f.velRot = (Math.random() - 0.5) * 1.6;
                f.el.style.opacity = "0";
                requestAnimationFrame(() => { f.el.style.opacity = "1"; });
            }
            if (x > marginright - f.tamaño) f.posx = aleatorio(marginright - f.tamaño);
            if (x < 0) f.posx = aleatorio(marginright - f.tamaño);
        }

        // Pétalos sueltos
        for (let i = 0; i < petalos.length; i++){
            let p = petalos[i];
            p.posy += p.sink;
            p.fase += p.balanceoFreq;
            let x = p.posx + Math.sin(p.fase) * p.balanceoAmp;
            p.rot += p.velRot;

            let distFondo = marginbottom - p.posy;
            if (distFondo < 100) p.el.style.opacity = Math.max(0, distFondo / 100).toFixed(2);

            p.el.style.left = x + "px";
            p.el.style.top  = p.posy + "px";
            p.el.style.transform = `rotate(${p.rot}deg)`;

            if (p.posy > marginbottom + p.tamaño * 2){
                p.posy = -p.tamaño - aleatorio(220);
                p.posx = aleatorio(marginright - p.tamaño);
                p.fase = Math.random() * Math.PI * 2;
                p.rot  = Math.random() * 360;
                p.velRot = (Math.random() - 0.5) * 3.2;
                p.el.style.opacity = "0";
                requestAnimationFrame(() => { p.el.style.opacity = "1"; });
            }
            if (x > marginright - p.tamaño) p.posx = aleatorio(marginright - p.tamaño);
            if (x < 0) p.posx = aleatorio(marginright - p.tamaño);
        }

        requestAnimationFrame(moverCempasuchil);
    }

    window.onload = initCempasuchil;
</script>
@endpush