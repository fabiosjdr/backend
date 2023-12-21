<?php

namespace Fabio\Bibliotecas\Depurador;

class Depurador
{
    private bool $depurar = false;
    private string $folder;
    private string $filePath;

    public function __construct(bool $depurar, string $folder) {
        $this->depurar = $depurar;
        $this->folder = $folder;

        if ($this->ativo()) $this->iniciar();
    }

    public function ativo(): bool
    {
        return $this->depurar;
    }

    private function iniciar(): void
    {
        if (!file_exists($this->folder)) mkdir($this->folder, 0777);

        $filename = (new \DateTime('now'))->format('Ymd-His');
        fopen($this->folder . $filename, 'w');

        $this->filePath = $this->folder . $filename;
    }

    public function escreverTexto(string $texto): void
    {
        $texto .= PHP_EOL;
        \file_put_contents($this->filePath, $texto, FILE_APPEND);
    }

    public function escreverVetor(array $info, string $titulo = null, bool $escreverChaves = false): void
    {
        if (!is_null($titulo)) {
            $this->escreverTexto(PHP_EOL . $titulo);
        }

        $textoParcial = array();

        if (!$escreverChaves) {
            $texto = implode(', ', $info);
        } else {
            foreach ($info as $key => $value) {
                if (!is_array($value)) $textoParcial[] = $key .': '. $value;
                else {
                    foreach ($value as $key2 => $value2) {
                        $textoParcial[] = $key . ' --- ' . $key2 . ': '. $value2 . '; ';
                    }
                }
            }

            $texto = implode(PHP_EOL, $textoParcial);
        }

        $this->escreverTexto($texto);
    }
}
