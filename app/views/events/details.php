<section class="event-details-section">
    <div class="container">

        <nav class="breadcrumb">
            <a href="<?php echo BASE_URL; ?>"><i class="fas fa-home"></i> Accueil</a>
            <span><i class="fas fa-chevron-right"></i></span>
            <a href="<?php echo BASE_URL; ?>events">Événements</a>
            <span><i class="fas fa-chevron-right"></i></span>
            <span><?php echo htmlspecialchars($event['title']); ?></span>
        </nav>


        <div class="event-details-card">

            <div class="event-details-header">
                <h1><?php echo htmlspecialchars($event['title']); ?></h1>

                <div class="event-meta" style="margin-top: 1rem;">
                    <?php if (!empty($event['event_date'])): ?>
                    <span class="meta-item" style="color: rgba(255,255,255,0.9);">
                        <i class="fas fa-calendar"></i>
                        <?php echo date('d/m/Y', strtotime($event['event_date'])); ?>
                    </span>
                    <?php endif; ?>

                    <?php if (!empty($event['event_time'])): ?>
                    <span class="meta-item" style="color: rgba(255,255,255,0.9);">
                        <i class="fas fa-clock"></i>
                        <?php echo substr($event['event_time'], 0, 5); ?>
                    </span>
                    <?php endif; ?>

                    <span class="meta-item" style="color: rgba(255,255,255,0.9);">
                        <i class="fas fa-map-marker-alt"></i>
                        <?php echo htmlspecialchars($event['location']); ?>
                    </span>
                </div>
            </div>


            <?php if (!empty($event['image']) && $event['image'] !== 'default.jpg'): ?>
            <div class="event-main-image">
                <img src="<?php echo BASE_URL; ?>uploads/<?php echo htmlspecialchars($event['image']); ?>"
                    alt="<?php echo htmlspecialchars($event['title']); ?>">
            </div>
            <?php endif; ?>

            <div class="event-details-body">

                <div class="event-info-grid">

                    <div class="info-card">
                        <div class="info-card-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="info-card-content">
                            <h4>Date</h4>
                            <p>
                                <?php 
                                if (!empty($event['event_date'])) {
                                    echo date('d F Y', strtotime($event['event_date']));
                                } else {
                                    echo 'Non définie';
                                }
                                ?>
                            </p>
                        </div>
                    </div>


                    <div class="info-card">
                        <div class="info-card-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="info-card-content">
                            <h4>Heure</h4>
                            <p>
                                <?php 
                                if (!empty($event['event_time'])) {
                                    echo substr($event['event_time'], 0, 5);
                                } else {
                                    echo 'Non définie';
                                }
                                ?>
                            </p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-card-content">
                            <h4>Lieu</h4>
                            <p><?php echo htmlspecialchars($event['location']); ?></p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-card-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="info-card-content">
                            <h4>Places disponibles</h4>
                            <p>
                                <strong><?php echo $availableSeats['available_seats'] ?? $event['seats']; ?></strong>
                                / <?php echo $event['seats']; ?>
                            </p>

                            <?php 
                                $totalSeats = $event['seats'];
                                $available = $availableSeats['available_seats'] ?? $totalSeats;
                                $reserved = $totalSeats - $available;
                                $percentUsed = ($reserved / $totalSeats) * 100;
                                
                                if ($percentUsed >= 90) {
                                    $progressClass = 'critical';
                                } elseif ($percentUsed >= 70) {
                                    $progressClass = 'warning';
                                } else {
                                    $progressClass = 'good';
                                }
                            ?>
                            <div class="seats-progress-wrapper">
                                <div class="seats-progress">
                                    <div class="seats-progress-bar <?php echo $progressClass; ?>"
                                        style="width: <?php echo $percentUsed; ?>%"></div>
                                </div>
                                <span class="seats-text">
                                    <?php echo $reserved; ?> réservation(s) effectuée(s)
                                </span>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="event-description-section">
                    <h2><i class="fas fa-align-left"></i> Description</h2>
                    <div class="description-content">
                        <?php echo nl2br(htmlspecialchars($event['description'])); ?>
                    </div>
                </div>


                <?php 
                    $isPast = !empty($event['event_date']) && strtotime($event['event_date']) < time();
                    $hasSeats = ($availableSeats['available_seats'] ?? $event['seats']) > 0;
                ?>

                <?php if (!$isPast && $hasSeats): ?>

                <div class="reservation-form-section">
                    <h2><i class="fas fa-ticket-alt"></i> Réserver votre place</h2>
                    <p class="form-subtitle">Remplissez le formulaire ci-dessous pour confirmer votre participation.</p>

                    <form action="<?php echo BASE_URL; ?>reservations/create" method="POST" id="reservationForm">
                        <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">

                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">
                                    <i class="fas fa-user"></i> Nom complet <span class="required">*</span>
                                </label>
                                <input type="text" id="name" name="name" placeholder="Votre nom complet" required
                                    minlength="2" maxlength="100">
                            </div>

                            <div class="form-group">
                                <label for="email">
                                    <i class="fas fa-envelope"></i> Email <span class="required">*</span>
                                </label>
                                <input type="email" id="email" name="email" placeholder="votre.email@exemple.com"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone">
                                <i class="fas fa-phone"></i> Téléphone
                            </label>
                            <input type="tel" id="phone" name="phone" placeholder="+216 XX XXX XXX">
                            <span class="field-hint">Optionnel - pour vous contacter si nécessaire</span>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-check-circle"></i>
                                <span>Confirmer la réservation</span>
                            </button>
                            <a href="<?php echo BASE_URL; ?>events" class="btn btn-secondary btn-lg">
                                <i class="fas fa-arrow-left"></i>
                                <span>Retour</span>
                            </a>
                        </div>
                    </form>
                </div>
                <?php elseif ($isPast): ?>

                <div class="alert alert-info" style="margin-top: 2rem;">
                    <i class="fas fa-info-circle"></i>
                    <div>
                        <strong>Événement terminé</strong>
                        <p style="margin: 0.25rem 0 0;">Cet événement a eu lieu le
                            <?php echo date('d/m/Y', strtotime($event['event_date'])); ?>.</p>
                    </div>
                </div>
                <div style="margin-top: 1.5rem;">
                    <a href="<?php echo BASE_URL; ?>events" class="btn btn-secondary">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Voir les autres événements</span>
                    </a>
                </div>
                <?php else: ?>

                <div class="alert alert-error" style="margin-top: 2rem;">
                    <i class="fas fa-exclamation-triangle"></i>
                    <div>
                        <strong>Événement complet</strong>
                        <p style="margin: 0.25rem 0 0;">Désolé, toutes les places ont été réservées pour cet événement.
                        </p>
                    </div>
                </div>
                <div style="margin-top: 1.5rem;">
                    <a href="<?php echo BASE_URL; ?>events" class="btn btn-secondary">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Voir les autres événements</span>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>