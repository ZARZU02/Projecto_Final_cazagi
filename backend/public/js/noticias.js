document.addEventListener("DOMContentLoaded", function() {
    // Event listeners para cada elemento de la barra de navegación
    document.getElementById("deportes").addEventListener("click", function() {
        obtenerNoticias("deportes");
    });
    document.getElementById("futbol").addEventListener("click", function() {
        obtenerNoticias("futbol");
    });
    document.getElementById("baloncesto").addEventListener("click", function() {
        obtenerNoticias("baloncesto");
    });
    document.getElementById("tennis").addEventListener("click", function() {
        obtenerNoticias("tennis");
    });
    document.getElementById("padel").addEventListener("click", function() {
        obtenerNoticias("padel");
    });
    document.getElementById("crear").addEventListener("click", function() {
        // Aquí podrías implementar la lógica para crear noticias, si es necesario
    });
});

async function obtenerNoticias(categoria) {
    try {
        // Ejemplo de URL dinámica según la categoría seleccionada
        let url;
        switch (categoria) {
            case "deportes":
                url = 'https://www.thesports.com/es/api/basketball';
                break;
            case "futbol":
                url = 'URL_DE_TU_API_DE_FUTBOL';
                break;
            case "baloncesto":
                url = 'URL_DE_TU_API_DE_BALONCESTO';
                break;
            case "tennis":
                url = 'URL_DE_TU_API_DE_TENNIS';
                break;
            case "padel":
                url = 'URL_DE_TU_API_DE_PADEL';
                break;
            default:
                console.error("Categoría no válida");
                return;
        }

        // Realizar solicitud a la API correspondiente
        const response = await fetch(url);
        const data = await response.json();
        
        // Mostrar las noticias en la sección correspondiente
        mostrarNoticias(data);
    } catch (error) {
        console.error('Error al obtener noticias:', error);
    }
}
