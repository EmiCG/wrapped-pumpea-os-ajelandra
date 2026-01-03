<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BirthdayController extends Controller
{
    public function index()
    {
        $slides = [
            [
                'titulo' => 'Ajelandra: The Mixtape',
                'subtitulo' => 'lo más dificil reealmente fue elegir de entre todas las fotos, la que más me gustan de ti...',
                'imagen' => asset('images/wrapped/foto1_ella.jpeg'),
                'color_hex' => '#E91429', // Red
            ],
            [
                'titulo' => 'La maeta más divina',
                'subtitulo' => 'por que no existe una sola en la que aparezcas que no sienta que me derrito por ti',
                'imagen' => asset('images/wrapped/foto2_ella.jpeg'),
                'color_hex' => '#F573A0', // Pink
            ],
            [
                'titulo' => 'En primera fila',
                'subtitulo' => 'Siempre seré tu fan número uno en todo lo que haces y tu fotógrafo personal, estoy muy orgulloso de ti ❤️',
                'imagen' => asset('images/wrapped/foto3_ella.jpeg'),
                'color_hex' => '#831843', // Dark Pink
            ],
            [
                'titulo' => 'Larregui te lo dijo por mi',
                'subtitulo' => '"Transparente y bella,
                                Pura como el Sol,
                                Eres real,
                                Y el espíritu más dulce que hay,
                                Bella pura como el Sol,
                                Eres real,
                                Y el espíritu más dulce que existe"',
                'imagen' => asset('images/wrapped/foto4_ella.jpeg'),
                'color_hex' => '#FF6437', // Orange
            ],
            [
                'titulo' => 'Kissito',
                'subtitulo' => 'Por un beso de la flaca yo daria lo que fuera...',
                'imagen' => asset('images/wrapped/foto5_pareja.jpeg'),
                'color_hex' => '#B02897', // Magenta
            ],
            [
                'titulo' => 'Mi Hit Favorito',
                'subtitulo' => 'Es el del sonido de tu risa cuando te haces la payasita... pero me encantas así de loquita',
                'imagen' => asset('images/wrapped/foto6_pareja.jpeg'),
                'color_hex' => '#E91429', // Red
            ],
            [
                'titulo' => 'Más años, más amor, más de ti por favor',
                'subtitulo' => 'Algo empalagoso, pero k me importa....',
                'imagen' => asset('images/wrapped/foto7_pareja.jpeg'),
                'color_hex' => '#F573A0', // Pink
            ],
            [
                'titulo' => "You’re the first day of spring with a septum piercing",
                'subtitulo' => "Te amo Little miss sweet dreams, tenneesse",
                'imagen' => asset('images/wrapped/foto8_pareja.jpeg'),
                'color_hex' => '#FF0000', // Bright Red
            ],
        ];

        return view('wrapped', compact('slides'));
    }
}
