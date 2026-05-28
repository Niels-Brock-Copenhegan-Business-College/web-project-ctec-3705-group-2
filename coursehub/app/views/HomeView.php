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
        $html .= '<div class="hero-actions">';
        $html .= '<a href="/programmes?level=Undergraduate" class="btn btn-accent btn-lg"><i class="fa fa-graduation-cap"></i> Undergraduate</a>';
        $html .= '<a href="/programmes?level=Postgraduate" class="btn btn-white btn-lg"><i class="fa fa-flask"></i> Postgraduate</a>';
        $html .= '<a href="/programmes" class="btn btn-lg" style="background:rgba(255,255,255,.15);color:#fff;border-color:rgba(255,255,255,.35)"><i class="fa fa-th-large"></i> All Programmes</a>';
        $html .= '</div></div></section>';

        $html .= '<div class="stats-strip" role="region" aria-label="Key statistics"><div class="stats-inner">';
        $html .= '<div class="stat-item"><div class="num">' . $stats['programmes'] . '</div><div class="lbl">Programmes</div></div>';
        $html .= '<div class="stat-item"><div class="num">' . $stats['modules'] . '</div><div class="lbl">Modules</div></div>';
        $html .= '<div class="stat-item"><div class="num">' . $stats['staff'] . '</div><div class="lbl">Academic Staff</div></div>';
        $html .= '<div class="stat-item"><div class="num">98%</div><div class="lbl">Graduate Employment</div></div>';
        $html .= '</div></div>';

        $html .= '<div class="container page-pad">';
        $html .= Layout::flash();

        $html .= '<div class="section-head mt-4"><h2>Find Your Programme</h2><p>Search by keyword or filter by study level</p></div>';
        $html .= '<form action="/programmes" method="GET" role="search" class="flex gap-2 flex-wrap items-center" style="background:var(--white);padding:1.5rem;border-radius:var(--radius);box-shadow:var(--shadow);border:1px solid var(--border-light)">';
        $html .= '<input type="search" name="search" class="form-control" placeholder="e.g. Computer Science, Data Science…" style="max-width:320px" aria-label="Search programmes">';
        $html .= '<select name="level" class="form-control" style="max-width:200px" aria-label="Level">';
        $html .= '<option value="">All levels</option><option value="Undergraduate">Undergraduate</option><option value="Postgraduate">Postgraduate</option>';
        $html .= '</select>';
        $html .= '<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>';
        $html .= '</form>';
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