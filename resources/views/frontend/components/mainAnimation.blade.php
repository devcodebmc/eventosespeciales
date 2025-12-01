@push('js')
<script>
    // Número de copos (recomendado entre 30 y 40)
    let nieve_cantidad = 35;

    // Colores azulados más claros para los copos
    let nieve_colorr = [
    "#5D8AA8", // azul acero claro
    "#6A9AB0", // azul hielo suave
    "#7BAFD4", // azul cielo invernal
    "#89CFF0", // azul pastel frío
    "#A3C1DA", // azul grisáceo claro
    "#B0C4DE"  // azul lavanda helado
    ];

    // Tipos de letra de los copos
    let nieve_tipo = ["Arial Black", "Arial Narrow", "Times New Roman", "Comic Sans MS"];

    // Símbolo de los copos
    let nieve_letra = "❅";

    // Velocidad de caída
    let nieve_velocidad = 1.2;

    // Tamaño máximo y mínimo de los copos
    let nieve_cantidadsize = 30;
    let nieve_chico = 15;

    // 1: toda la página | 2: izquierda | 3: centro | 4: derecha
    let nieve_zona = 1;

    let nieve = [];
    let marginbottom, marginright;
    let x_mv = [], crds = [], lftrght = [];

    function aleatorio(range) {
        return Math.floor(range * Math.random());
    }

    function initnieve() {
        marginbottom = Math.max(document.body.scrollHeight, document.documentElement.scrollHeight);
        marginright = Math.max(document.body.clientWidth, document.documentElement.clientWidth);

        let nievesizerange = nieve_cantidadsize - nieve_chico;

        for (let i = 0; i <= nieve_cantidad; i++) {
            crds[i] = 0;
            lftrght[i] = Math.random() * 15;
            x_mv[i] = 0.03 + Math.random() / 10;

            let span = document.createElement("span");
            span.id = "s" + i;
            span.style.position = "absolute";
            span.style.top = "-" + nieve_cantidadsize + "px";
            span.style.fontFamily = nieve_tipo[aleatorio(nieve_tipo.length)];
            span.style.fontSize = aleatorio(nievesizerange) + nieve_chico + "px";
            span.style.color = nieve_colorr[aleatorio(nieve_colorr.length)];
            span.textContent = nieve_letra;
            document.body.appendChild(span);

            nieve[i] = span;
            nieve[i].sink = (nieve_velocidad * parseInt(nieve[i].style.fontSize)) / 5;

            // Posición inicial según zona
            if (nieve_zona === 1) {
                nieve[i].posx = aleatorio(marginright - parseInt(nieve[i].style.fontSize));
            } else if (nieve_zona === 2) {
                nieve[i].posx = aleatorio(marginright / 2 - parseInt(nieve[i].style.fontSize));
            } else if (nieve_zona === 3) {
                nieve[i].posx = aleatorio(marginright / 2 - parseInt(nieve[i].style.fontSize)) + marginright / 4;
            } else if (nieve_zona === 4) {
                nieve[i].posx = aleatorio(marginright / 2 - parseInt(nieve[i].style.fontSize)) + marginright / 2;
            }

            nieve[i].posy = aleatorio(marginbottom - 2 * parseInt(nieve[i].style.fontSize));
            nieve[i].style.left = nieve[i].posx + "px";
            nieve[i].style.top = nieve[i].posy + "px";
        }

        movenieve();
    }

    function movenieve() {
        for (let i = 0; i <= nieve_cantidad; i++) {
            crds[i] += x_mv[i];
            nieve[i].posy += nieve[i].sink;
            nieve[i].style.left = nieve[i].posx + lftrght[i] * Math.sin(crds[i]) + "px";
            nieve[i].style.top = nieve[i].posy + "px";

            // Reinicio de posición cuando el copo llega al fondo o se sale del área
            if (nieve[i].posy >= marginbottom - 2 * parseInt(nieve[i].style.fontSize) ||
                parseInt(nieve[i].style.left) > marginright - 3 * lftrght[i]) {

                if (nieve_zona === 1) {
                    nieve[i].posx = aleatorio(marginright - parseInt(nieve[i].style.fontSize));
                } else if (nieve_zona === 2) {
                    nieve[i].posx = aleatorio(marginright / 2 - parseInt(nieve[i].style.fontSize));
                } else if (nieve_zona === 3) {
                    nieve[i].posx = aleatorio(marginright / 2 - parseInt(nieve[i].style.fontSize)) + marginright / 4;
                } else if (nieve_zona === 4) {
                    nieve[i].posx = aleatorio(marginright / 2 - parseInt(nieve[i].style.fontSize)) + marginright / 2;
                }

                nieve[i].posy = 0;
            }
        }

        setTimeout(movenieve, 50);
    }

    window.onload = initnieve;
</script>
@endpush