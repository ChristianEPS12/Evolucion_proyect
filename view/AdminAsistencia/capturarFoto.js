const videoWidth = 420;
const videoHeight = 320;
const videoTag = document.getElementById("theVideo");
const canvasTag = document.getElementById("theCanvas");
const btnCapture = document.getElementById("btnCapture");
const btnDownloadImage = document.getElementById("btnDownloadImage");
const btnSendImageToServer = document.getElementById("btnSendImageToServer");
const btnStartCamera = document.getElementById("btnStartCamera");

let cameraActive = false; // Variable para rastrear el estado de la cámara

// Establecer estado inicial de los botones
btnCapture.disabled = true;
btnDownloadImage.disabled = true;
btnSendImageToServer.disabled = true;

// Configurar los atributos de video y canvas
videoTag.setAttribute("width", videoWidth);
videoTag.setAttribute("height", videoHeight);
canvasTag.setAttribute("width", videoWidth);
canvasTag.setAttribute("height", videoHeight);

// Evento para iniciar la cámara
btnStartCamera.addEventListener("click", async () => {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({
            audio: false,
            video: { width: videoWidth, height: videoHeight },
        });
        videoTag.srcObject = stream;
        btnStartCamera.disabled = true;

        // Habilitar el botón de captura cuando la cámara esté activa
        cameraActive = true;
        btnCapture.disabled = false;
    } catch (error) {
        console.log("Error al iniciar la cámara:", error);
    }
});

// Evento para capturar la imagen y obtener la ubicación
btnCapture.addEventListener("click", () => {
const canvasContext = canvasTag.getContext("2d");
canvasContext.drawImage(videoTag, 0, 0, videoWidth, videoHeight);
btnDownloadImage.disabled = false;
btnSendImageToServer.disabled = false;

// Obtener la ubicación cuando se captura la imagen
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
        const lat = position.coords.latitude;
        const lon = position.coords.longitude;

        // Mostrar las coordenadas en los campos
        document.getElementById("latitud").value = lat;
        document.getElementById("longitud").value = lon;
    }, function (error) {
        console.error("Error al obtener la ubicación:", error);
    });
} else {
    alert("Geolocalización no soportada por este navegador.");
}

// Obtener la hora actual y rellenar el campo
const now = new Date();
const currentTime = now.toTimeString().split(" ")[0]; // Obtener solo la hora (HH:mm:ss)
document.getElementById("hora").value = currentTime;

});
// Botón para forzar la descarga de la imagen
btnDownloadImage.addEventListener("click", () => {
    const link = document.createElement("a");
    link.download = "capturedImage.png";
    link.href = canvasTag.toDataURL();
    link.click();
});

btnSendImageToServer.addEventListener("click", async () => {
    const dataURL = canvasTag.toDataURL(); // Tomar la imagen del canvas
    const blob = await dataURLtoBlob(dataURL); // Convertir la imagen a Blob
    const data = new FormData();
    data.append("capturedImage", blob, "capturedImage.png"); // Enviar la imagen como 'capturedImage'

    try {
        const response = await axios.post("../../controller/upload_foto.php", data, {
            headers: { "Content-Type": "multipart/form-data" },
        });

        // Verificar si la imagen se subió correctamente
        if (response.status === 200 && response.data.status === 'success') {
            const fileName = response.data.fileName; // Obtener el nombre del archivo subido

            // Aquí haces una nueva solicitud para insertar los datos en la base de datos
            const asistenciaData = new FormData();
            asistenciaData.append('usu_id', $('#usu_id').val()); // Usuario
            asistenciaData.append('fecha', $('#fecha').val()); // Fecha
            asistenciaData.append('hora', $('#hora').val()); // Hora
            asistenciaData.append('latitud', $('#latitud').val()); // Latitud
            asistenciaData.append('longitud', $('#longitud').val()); // Longitud
            asistenciaData.append('foto', fileName); // Nombre de la foto

            // Llamar a la función del backend para guardar la asistencia
            const asistenciaResponse = await axios.post("../../controller/asistencia.php?op=guardaryeditar", asistenciaData, {
                headers: { "Content-Type": "multipart/form-data" },
            });

            if (asistenciaResponse.status === 200) {
                alert("Asistencia registrada exitosamente.");
            } else {
                alert("Error al registrar la asistencia.");
            }
        } else {
            alert("Error al subir la imagen: " + response.data.message); // Mensaje de error
        }
    } catch (error) {
        console.error("Error al enviar la imagen:", error);
        alert("Ocurrió un error al intentar subir la imagen."); // Mensaje en caso de error
    }
});
// Función para convertir dataURL a Blob
async function dataURLtoBlob(dataURL) {
    const arr = dataURL.split(",");
    const mime = arr[0].match(/:(.*?);/)[1];
    const bstr = atob(arr[1]);
    const n = bstr.length;
    const u8arr = new Uint8Array(n);
    for (let i = 0; i < n; i++) {
        u8arr[i] = bstr.charCodeAt(i);
    }
    return new Blob([u8arr], { type: mime });
}


