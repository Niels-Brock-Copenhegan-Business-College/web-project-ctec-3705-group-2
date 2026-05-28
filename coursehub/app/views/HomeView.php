<?php
declare(strict_types=1);
/**
 * HomeView — Renders the public homepage including hero section,
 * statistics strip, search form, featured programmes, and why-choose-us cards.
 */
class HomeView {
    public function render(array $stats, array $featured): string {
        $html  = Layout::head('Welcome — Find Your Degree Programme');
        $html .= Layout::nav('/');
        $html .= '<main id="main">';
        $html .= '<section class="hero" aria-labelledby="hero-h">';
        $html .= '<div class="hero-content">';
        $html .= '<h1 id="hero-h">Discover Your Future at CourseHub</h1>';
       $html .= '<p>Explore world-class undergraduate and postgraduate programmes. Find the course that matches your ambition, register your interest, and take the first step towards your career.</p>';
        // TODO: Add hero action buttons here
        $html .= '</div></section>';

        // TODO: Add statistics strip here

        $html .= '<div class="container page-pad">';
        $html .= Layout::flash();

        // TODO: Add search form here

        // Featured programmes
        $html .= '<div class="section-head"><h2>Featured Programmes</h2><p>Explore some of our most popular degree programmes</p></div>';
        $html .= '<div class="grid-3">';
        foreach (array_slice($featured,0,6) as $p) {
            $html .= self::progCard($p, false);
        }
        $html .= '</div>';
        $html .= '<div class="mt-3 text-right"><a href="/programmes" class="btn btn-outline"><i class="fa fa-arrow-right"></i> View all programmes</a></div>';

        // TODO: Add Why Choose Us section here

        $html .= '</div></main>';
        $html .= Layout::footer();
        return $html;
    }

    public static function progCard(array $p, bool $showFav = true): string {
        $title  = htmlspecialchars($p['title'],ENT_QUOTES,'UTF-8');
        $slug   = htmlspecialchars($p['slug'],ENT_QUOTES,'UTF-8');
        $level  = htmlspecialchars($p['level'],ENT_QUOTES,'UTF-8');
        $desc   = htmlspecialchars(mb_substr($p['description']??'',0,120),ENT_QUOTES,'UTF-8');
        $leader = htmlspecialchars($p['leader_name']??'',ENT_QUOTES,'UTF-8');
        $badge  = $p['level']==='Undergraduate'?'badge-ug':'badge-pg';
        $dur    = (int)($p['duration_years']??3);
        $img    = !empty($p['image_url'])
            ? '<img src="'.htmlspecialchars($p['image_url'],ENT_QUOTES).'" alt="'.htmlspecialchars($p['title'],ENT_QUOTES).'">'
            : '<span style="font-size:4rem">🎓</span>';

        $html  = '<article class="prog-card">';
        $html .= '<div class="prog-card-img">' . $img . '</div>';
        $html .= '<div class="prog-card-body">';
        $html .= '<div class="flex items-center gap-1 mb-1"><span class="badge ' . $badge . '">' . $level . '</span>';
        $html .= '<span class="text-xs text-muted"><i class="fa fa-clock"></i> ' . $dur . ' yr' . ($dur>1?'s':'') . '</span></div>';
        $html .= '<h2 class="font-bold" style="font-size:1.05rem;margin-bottom:.4rem"><a href="/programmes/' . $slug . '" style="color:var(--navy)">' . $title . '</a></h2>';
        if ($leader) $html .= '<p class="text-xs text-muted mb-1"><i class="fa fa-user-tie"></i> ' . $leader . '</p>';
        $html .= '<p class="text-sm text-muted">' . $desc . (strlen($p['description']??'')>120?'…':'') . '</p>';
        $html .= '</div>';
        $html .= '<div class="prog-card-footer">';
        $html .= '<a href="/programmes/' . $slug . '" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> View</a>';
        // TODO: Add favourite button here
        $html .= '</div></article>';
        return $html;
    }
}