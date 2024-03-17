<?php

namespace Database\Seeders;

use App\Models\Star;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class StarSeeder extends Seeder
{

    /**
     * Some starter default stars
     * 
     * Bring light to fighting game scene, hollywood is full of envy
     */
    private $starterStars = [
        [
            "firstname" => "Daigo",
            "lastname" => "Umehara",
            "description" => [
                "Daigo Umehara (Japanese: 梅原 大吾, Hepburn: Umehara Daigo, born 19 May 1981) is a Japanese esports player and author who competes competitively at fighting video games.",
                "He specializes in 2D arcade fighting games, mainly those released by Capcom.",
                "Known as \"Daigo\" or \"The Beast\" in the West and \"Umehara\" (ウメハラ, written in katakana instead of kanji) or \"Ume\" in Japan, Daigo is one of the world's most famous Street Fighter players and is often considered its greatest.",
                "His longevity is seen as an incredibly rare thing in the world of competitive video games.",
                "He currently holds a world record of \"the most successful player in major tournaments of Street Fighter\" in the Guinness World Records and is a six time Evo Championship Series winner.",
                "Before properly being called a pro gamer from signing a sponsorship deal with Mad Catz, Japanese media usually referred to Daigo as \"the god of 2D fighting games\" (2D格闘ゲームの神, 2D Kakutō Gēmu no Kami)."
            ]
        ],
        [
            "firstname" => "William",
            "lastname" => "Belaid",
            "description" =>  [
                "William Belaïd (born June 1, 1995), commonly known as Glutonny, is a French professional Super Smash Bros. player.",
                "He is the highest ranked Super Smash Bros. Ultimate player from Europe.",
                "In Super Smash Bros. for Wii U, he was ranked the 70th best player in the world of all time.",
                "In Ultimate, he was ranked 14th and 8th best in the world for the first and second halves of 2019, respectively.",
                "In April 2022 he won Pound 2022, becoming the first European player to win a major Ultimate tournament outside Europe.",
                "Glutonny has used Wario as his primary character in all three Smash Bros. titles in which he has competed; he was considered the best Wario in Europe in Super Smash Bros. Brawl, the best Wario in the world in Smash for Wii U, and contends for best Wario in the world in Ultimate."
            ]
        ],
        [
            "firstname" => "Lee",
            "lastname" => "Sang-hyeok",
            "description" => [
                "Lee Sang-hyeok (Korean: 이상혁; born May 7, 1996), better known as Faker, is a South Korean professional League of Legends player for T1.",
                "He gained prominence after joining SK Telecom T1 (now T1) in 2013, where he has since played as the team's mid-laner.",
                "Throughout his career, he has secured a record of 10 League of Legends Champions Korea (LCK) titles, two Mid-Season Invitational (MSI) titles, and a record four World Championship titles.",
                "Faker is widely regarded as the greatest League of Legends player in history and has drawn comparison analogizing him to basketball player, Michael Jordan for his esports success."
            ]
        ]
    ];

    public function run(): void
    {
        Star::factory(count($this->starterStars))->state(new Sequence(...$this->starterStars))->create();
    }
}
