<?php

require_once 'guzzleHelper.php';

class CatApiHelper extends GuzzleHelper {
    public function __construct() {
        parent::__construct('https://api.thecatapi.com/v1/', [
            'x-api-key' => 'live_osQOYIgj59115waa8hMucnt5Tt9vu4DciEwUtNe10vFW2LRoizWOup8ARzvxHRja' 
            // Reemplazar con la key de The Cat API
        ]);
    }

    /**
     * Obtiene la lista de razas de gatos.
     * @return array
     */
    public function getBreeds() {
        return $this->getRequest('breeds');
    }

    /**
     * Obtiene imágenes de gatos por raza.
     * @param string $breedId
     * @param int $limit
     * @return array
     */
    public function getImagesByBreed($breedId, $limit = 1) {
        return $this->getRequest('images/search', queryParams: ['breed_id' => $breedId, 'limit' => $limit]);
    }

    /**
     * Obtiene detalles de una raza específica.
     * @param string $breedId
     * @return array
     */
    public function getBreedDetails($breedId) {
        return $this->getRequest('breeds/' . $breedId);
    }

    public static function getImageUrl($imagenId) {
        return "https://cdn2.thecatapi.com/images/{$imagenId}.jpg";
    }
}
?>