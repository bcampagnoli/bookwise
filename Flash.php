<?php
class Flash
{
    public function push($chave, $valor)
    {
        $_SESSION["flash_chave"] = $valor;
    }

    public function get($chave)
    {
        if (!isset($_SESSION["flash_chave"])) {
            return false;
        }

        $valor = $_SESSION["flash_chave"];
        unset($_SESSION["flash_chave"]);

        return $valor;
    }
}
