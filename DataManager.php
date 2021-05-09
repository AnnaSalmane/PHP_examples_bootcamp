<?php
class DataManager
{
    /*
     * Mainīgais satur visas datubāzes tabulu divdimensionālā masīvā
     */
    private $table = [];
    private $file_name = '';

    public function __construct($filename)
    {
        $this->file_name = $filename;
        if (file_exists($this->file_name)) { // pārbauda vai eksistē
            $content = file_get_contents($this->file_name);  // ja eksistē, tad tos failus paņem
            $data = json_decode($content, true); // šī līnija pārvērš failus no $content php saprotamā valodā
            if (is_array($data)) {  // pārbauda vai tas ir masīvs 
                $this->table = $data;  // ja apstiprinās, tad vērtības ierakstās iekš table
            }
        }
    }

    /*
     * Saglabā vērtību iekš datubāzes ar atslēgām $r un $c
     * @param integer $r - pirmā atslēga
     * @param integer $c - otrā atslēga
     * @param mixed $value - vērtība kas tiks saglabāta datu bāzē 
     */

    public function save($r, $c, $value)
    {
        $this->table[$r][$c] = $value;
        $content = json_encode($this->table, JSON_PRETTY_PRINT);  // faila saturu no php valodas pāraksta json. JSON_PRETTY_PRINT uzraksta json failu strukturāli smukāk, lasāmāk
        file_put_contents($this->file_name, $content); // ieraksta failā... file_put_contents ieraksta json failā
    }

    /*
     * Atgriež vērtību no datubāzes kas atbilst atslēgām $r un $c
     * @param integer $r - pirmā atslēga
     * @param integer $c - otrā atslēga
     * 
     * @return mixed vērtība no datubāzes vai tukšu stringu
     */

    public function get($r, $c)
    {
        if (array_key_exists($r, $this->table) && array_key_exists($c, $this->table[$r])) {  // pārbauda vai tā vērtība tika jau iepriekš uzdota... array_key_exists($c, $this->table[$r]) pārbauda vai attiecīgajā rindā ir arī attiecīgā kollona
            return $this->table[$r][$c];   // ja abi apstirinās, tad izvada vērtības
        }

        return '';  // ja neapstiprinājās, tad izvada tukšu tekstu
    }

    /*
     *
     * @return ineger 
     */
    public function count()
    {                          // ar šo funkciju skaita x un o. Jo ja būs pāra skaitlis, tad varēs spreist ka nākamajam gājiens ir o
        $count = 0;
        foreach ($this->table as $row) {  // masīvs atkārtosies tik reizes cik tajā ir elementi
            foreach ($row as $value) {  // iet cauri katrai rindai
                $count++;  // tas palielinās vērtību par 1
            }
        }
        return $count;
    }

    public function deleteAll()
    {
        $this->table = []; // tabula ir tukšs masīvs
        file_put_contents($this->file_name, '');
    }
}
