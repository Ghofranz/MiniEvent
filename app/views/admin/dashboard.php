<section class="dashboard-section">
    <div class="container">

        <div class="dashboard-header">
            <div>
                <h1 style="color: azure;"><i class="fas fa-tachometer-alt"></i> Tableau de bord</h1>
                <p class="welcome-text">
                    Bienvenue, <strong><?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?></strong>
                    👋
                </p>
            </div>
            <a href="<?php echo BASE_URL; ?>admin/events/create" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                <span>Nouvel événement</span>
            </a>
        </div>


        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon bg-primary">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $totalEvents; ?></h3>
                    <p>Événements</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon bg-success">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $totalReservations; ?></h3>
                    <p>Réservations</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon bg-info">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-info">
                    <?php 
                        $upcomingCount = 0;
                        foreach ($events as $e) {
                            if (!empty($e['event_date']) && strtotime($e['event_date']) >= time()) {
                                $upcomingCount++;
                            }
                        }
                    ?>
                    <h3><?php echo $upcomingCount; ?></h3>
                    <p>À venir</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon bg-warning">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $totalEvents - $upcomingCount; ?></h3>
                    <p>Terminés</p>
                </div>
            </div>
        </div>

        <div class="dashboard-card">
            <div class="card-header">
                <h2><i class="fas fa-list"></i> Gestion des événements</h2>
                <span class="badge"><?php echo count($events); ?> événement(s)</span>
            </div>

            <?php if (empty($events)): ?>
            <div class="no-data">
                <i class="fas fa-calendar-plus"></i>
                <h3>Aucun événement</h3>
                <p>Commencez par créer votre premier événement</p>
                <a href="<?php echo BASE_URL; ?>admin/events/create" class="btn btn-primary" style="margin-top: 1rem;">
                    <i class="fas fa-plus"></i>
                    <span>Créer un événement</span>
                </a>
            </div>
            <?php else: ?>
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Date</th>
                            <th>Lieu</th>
                            <th>Places</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $event): ?>
                        <?php 
                                    $isPast = !empty($event['event_date']) && strtotime($event['event_date']) < time();
                                ?>
                        <tr>
                            <td>
                                <strong><?php echo htmlspecialchars($event['title']); ?></strong>
                            </td>
                            <td>
                                <?php if (!empty($event['event_date'])): ?>
                                <div style="display: flex; flex-direction: column;">
                                    <span style="font-weight: 600;">
                                        <?php echo date('d/m/Y', strtotime($event['event_date'])); ?>
                                    </span>
                                    <?php if (!empty($event['event_time'])): ?>
                                    <small style="color: var(--gray-500);">
                                        <i class="fas fa-clock"></i>
                                        <?php echo substr($event['event_time'], 0, 5); ?>
                                    </small>
                                    <?php endif; ?>
                                </div>
                                <?php else: ?>
                                <span style="color: var(--gray-400);">Non définie</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span style="display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="fas fa-map-marker-alt" style="color: var(--primary);"></i>
                                    <?php echo htmlspecialchars($event['location']); ?>
                                </span>
                            </td>
                            <td>
                                <span style="font-weight: 600;"><?php echo $event['seats']; ?></span>
                            </td>
                            <td>
                                <span class="status-badge <?php echo $isPast ? 'status-past' : 'status-upcoming'; ?>">
                                    <?php echo $isPast ? 'Terminé' : 'À venir'; ?>
                                </span>
                            </td>
                            <td class="actions-cell">
                                <div class="action-buttons">
                                    <!-- View -->
                                    <a href="<?php echo BASE_URL; ?>events/details?id=<?php echo $event['id']; ?>"
                                        class="btn btn-small btn-secondary" title="Voir" target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="<?php echo BASE_URL; ?>admin/events/edit?id=<?php echo $event['id']; ?>"
                                        class="btn btn-small btn-info" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Reservations -->
                                    <a href="<?php echo BASE_URL; ?>admin/events/reservations?event_id=<?php echo $event['id']; ?>"
                                        class="btn btn-small btn-success" title="Réservations">
                                        <i class="fas fa-users"></i>
                                    </a>

                                    <!-- Delete -->
                                    <a href="<?php echo BASE_URL; ?>admin/events/delete?id=<?php echo $event['id']; ?>"
                                        class="btn btn-small btn-danger" title="Supprimer"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>