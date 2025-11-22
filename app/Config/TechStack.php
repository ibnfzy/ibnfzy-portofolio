<?php

namespace App\Config;

use CodeIgniter\Config\BaseConfig;

class TechStack extends BaseConfig
{
    /**
     * Preset technology stack options. Each item carries a unique id, a label,
     * a badge (short text shown inside the SVG), and a background color used
     * when rendering the inline SVG icon.
     */
    public array $icons = [
        ['id' => 'php', 'label' => 'PHP', 'badge' => 'PHP', 'color' => '#8892bf'],
        ['id' => 'codeigniter', 'label' => 'CodeIgniter', 'badge' => 'CI', 'color' => '#ee4323'],
        ['id' => 'laravel', 'label' => 'Laravel', 'badge' => 'LV', 'color' => '#f55247'],
        ['id' => 'javascript', 'label' => 'JavaScript', 'badge' => 'JS', 'color' => '#f7df1e'],
        ['id' => 'typescript', 'label' => 'TypeScript', 'badge' => 'TS', 'color' => '#3178c6'],
        ['id' => 'react', 'label' => 'React', 'badge' => 'RE', 'color' => '#61dafb'],
        ['id' => 'vue', 'label' => 'Vue.js', 'badge' => 'VUE', 'color' => '#41b883'],
        ['id' => 'nextjs', 'label' => 'Next.js', 'badge' => 'NX', 'color' => '#111827'],
        ['id' => 'node', 'label' => 'Node.js', 'badge' => 'ND', 'color' => '#3c873a'],
        ['id' => 'tailwind', 'label' => 'Tailwind CSS', 'badge' => 'TW', 'color' => '#38bdf8'],
        ['id' => 'bootstrap', 'label' => 'Bootstrap', 'badge' => 'BS', 'color' => '#7952b3'],
        ['id' => 'html', 'label' => 'HTML5', 'badge' => 'HT', 'color' => '#e34f26'],
        ['id' => 'css', 'label' => 'CSS3', 'badge' => 'CS', 'color' => '#1572b6'],
        ['id' => 'mysql', 'label' => 'MySQL', 'badge' => 'MY', 'color' => '#00618a'],
        ['id' => 'postgres', 'label' => 'PostgreSQL', 'badge' => 'PG', 'color' => '#336791'],
        ['id' => 'docker', 'label' => 'Docker', 'badge' => 'DK', 'color' => '#2496ed'],
        ['id' => 'redis', 'label' => 'Redis', 'badge' => 'RD', 'color' => '#dc382d'],
        ['id' => 'git', 'label' => 'Git', 'badge' => 'GT', 'color' => '#f34f29'],
    ];
}
