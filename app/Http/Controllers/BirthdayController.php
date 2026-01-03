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
                'titulo' => 'Primera fila',
                'subtitulo' => 'siempre seré tu fan número uno en todo lo que haces y tu fotógrafo personal ❤️',
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
                'subtitulo' => 'Eres mi canción favorita puesta en repeat, una y otra vez.',
                'imagen' => asset('images/wrapped/foto5_pareja.jpeg'),
                'color_hex' => '#B02897', // Magenta
            ],
            [
                'titulo' => 'Mi Hit Favorito',
                'subtitulo' => 'Es el de tu risa, y me ves con esos ojitos que me derriten.',
                'imagen' => asset('images/wrapped/foto6_pareja.jpeg'),
                'color_hex' => '#E91429', // Red
            ],
            [
                'titulo' => 'It’s love like a tongue in a nostril',
                'subtitulo' => 'Love like an ache in the jaw',
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
