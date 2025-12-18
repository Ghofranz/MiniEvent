<section class="hero">
    <div class="container">
        <h1><i class="fas fa-sparkles"></i> Nos Événements</h1>
        <p>Découvrez une sélection d'événements exceptionnels et réservez votre place en quelques clics</p>
    </div>


    <div class="hero-decoration" style="width: 300px; height: 300px; top: -100px; left: -100px;"></div>
    <div class="hero-decoration" style="width: 200px; height: 200px; bottom: -50px; right: 10%; animation-delay: 2s;">
    </div>

</section>

<section class="events-section">
    <div class="container">
        <?php if (empty($events)): ?>

        <div class="no-events">
            <i class="fas fa-calendar-xmark"></i>
            <h3>Aucun événement disponible</h3>
            <p>Revenez bientôt pour découvrir nos prochains événements passionnants !</p>
        </div>
        <?php else: ?>

        <div class="events-grid">
            <?php foreach ($events as $event): ?>
            <?php 
                        
                        $eventDate = !empty($event['event_date']) ? strtotime($event['event_date']) : time();
                        $isPast = $eventDate < time();
                        
                       
                        $day = !empty($event['event_date']) ? date('d', $eventDate) : '--';
                        $month = !empty($event['event_date']) ? strtoupper(date('M', $eventDate)) : '---';
                    ?>

            <article class="event-card">

                <div class="event-image">



                    <div class="event-date-badge">
                        <span class="day"><?php echo $day; ?></span>
                        <span class="month"><?php echo $month; ?></span>
                    </div>


                    <span class="event-badge <?php echo $isPast ? 'past' : 'upcoming'; ?>">
                        <?php echo $isPast ? 'Terminé' : 'À venir'; ?>
                    </span>
                </div>


                <div class="event-content">
                    <h3><?php echo htmlspecialchars($event['title']); ?></h3>

                    <div class="event-meta">
                        <?php if (!empty($event['event_time'])): ?>
                        <span class="meta-item">
                            <i class="fas fa-clock"></i>
                            <?php echo substr($event['event_time'], 0, 5); ?>
                        </span>
                        <?php endif; ?>

                        <span class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <?php echo htmlspecialchars($event['location']); ?>
                        </span>

                        <span class="meta-item">
                            <i class="fas fa-users"></i>
                            <?php echo $event['seats']; ?> places
                        </span>
                    </div>

                    <p class="event-description">
                        <?php echo htmlspecialchars(substr($event['description'], 0, 120)); ?>
                        <?php echo strlen($event['description']) > 120 ? '...' : ''; ?>
                    </p>

                    <div class="event-actions">
                        <a href="<?php echo BASE_URL; ?>events/details?id=<?php echo $event['id']; ?>"
                            class="btn btn-primary">
                            <span>Voir détails</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>