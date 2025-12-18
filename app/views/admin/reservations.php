<section class="event-details-section">
    <div class="container">

        <nav class="breadcrumb">
            <a href="<?php echo BASE_URL; ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <span><i class="fas fa-chevron-right"></i></span>
            <span>Réservations</span>
            <?php if (isset($event)): ?>
            <span><i class="fas fa-chevron-right"></i></span>
            <span><?php echo htmlspecialchars($event['title']); ?></span>
            <?php endif; ?>
        </nav>

        <!-- Reservations Card -->
        <div class="dashboard-card">
            <div class="card-header">
                <h2>
                    <i class="fas fa-users"></i>
                    Réservations
                    <?php if (isset($event)): ?>
                    – <?php echo htmlspecialchars($event['title']); ?>
                    <?php endif; ?>
                </h2>
                <span class="badge"><?php echo count($reservations); ?> réservation(s)</span>
            </div>

            <?php if (isset($event)): ?>

            <div
                style="display: flex; flex-wrap: wrap; gap: 2rem; padding: 1.5rem 2rem; background: var(--gray-50); border-bottom: 1px solid var(--gray-100);">
                <?php if (!empty($event['event_date'])): ?>
                <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--gray-600);">
                    <i class="fas fa-calendar" style="color: var(--primary);"></i>
                    <?php echo date('d/m/Y', strtotime($event['event_date'])); ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($event['event_time'])): ?>
                <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--gray-600);">
                    <i class="fas fa-clock" style="color: var(--primary);"></i>
                    <?php echo substr($event['event_time'], 0, 5); ?>
                </div>
                <?php endif; ?>

                <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--gray-600);">
                    <i class="fas fa-map-marker-alt" style="color: var(--primary);"></i>
                    <?php echo htmlspecialchars($event['location']); ?>
                </div>

                <div style="display: flex; align-items: center; gap: 0.5rem; color: var(--gray-600);">
                    <i class="fas fa-ticket-alt" style="color: var(--primary);"></i>
                    <?php echo count($reservations); ?> / <?php echo $event['seats']; ?> places
                </div>
            </div>
            <?php endif; ?>

            <?php if (empty($reservations)): ?>
            <div class="no-data">
                <i class="fas fa-inbox"></i>
                <h3>Aucune réservation</h3>
                <p>Il n'y a pas encore de réservations pour cet événement.</p>
            </div>
            <?php else: ?>
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Date de réservation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($reservations as $r): ?>
                        <tr>
                            <td>
                                <span
                                    style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: var(--primary-gradient); color: white; border-radius: 50%; font-size: 0.85rem; font-weight: 600;">
                                    <?php echo $i++; ?>
                                </span>
                            </td>
                            <td>
                                <strong><?php echo htmlspecialchars($r['name']); ?></strong>
                            </td>
                            <td>
                                <a href="mailto:<?php echo htmlspecialchars($r['email']); ?>"
                                    style="display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="fas fa-envelope" style="color: var(--primary);"></i>
                                    <?php echo htmlspecialchars($r['email']); ?>
                                </a>
                            </td>
                            <td>
                                <?php if (!empty($r['phone'])): ?>
                                <a href="tel:<?php echo htmlspecialchars($r['phone']); ?>"
                                    style="display: flex; align-items: center; gap: 0.5rem;">
                                    <i class="fas fa-phone" style="color: var(--success);"></i>
                                    <?php echo htmlspecialchars($r['phone']); ?>
                                </a>
                                <?php else: ?>
                                <span style="color: var(--gray-400);">—</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span style="display: flex; align-items: center; gap: 0.5rem; color: var(--gray-500);">
                                    <i class="fas fa-clock"></i>
                                    <?php echo date('d/m/Y à H:i', strtotime($r['created_at'])); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Export Actions -->
            <div style="display: flex; gap: 1rem; padding: 1.5rem 2rem; border-top: 1px solid var(--gray-100);">
                <button onclick="exportToCSV()" class="btn btn-secondary">
                    <i class="fas fa-download"></i>
                    <span>Exporter CSV</span>
                </button>
                <button onclick="window.print()" class="btn btn-secondary">
                    <i class="fas fa-print"></i>
                    <span>Imprimer</span>
                </button>
            </div>
            <?php endif; ?>
        </div>

        <!-- Back Button -->
        <div style="margin-top: 2rem;">
            <a href="<?php echo BASE_URL; ?>admin/dashboard" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                <span>Retour au dashboard</span>
            </a>
        </div>
    </div>
</section>

<script>
function exportToCSV() {
    const table = document.querySelector('.data-table');
    if (!table) return;

    let csv = [];
    const rows = table.querySelectorAll('tr');

    rows.forEach(row => {
        const cols = row.querySelectorAll('td, th');
        const rowData = [];
        cols.forEach(col => {
            let text = col.innerText.replace(/"/g, '""').trim();
            rowData.push('"' + text + '"');
        });
        csv.push(rowData.join(','));
    });

    const csvContent = csv.join('\n');
    const blob = new Blob([csvContent], {
        type: 'text/csv;charset=utf-8;'
    });
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'reservations_<?php echo date('Y-m-d'); ?>.csv';
    link.click();
}
</script>