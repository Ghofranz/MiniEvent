<?php 
$action = $action ?? 'create'; 
$isEdit = ($action === 'edit');
?>


<section class="event-details-section">
    <div class="container">

        <nav class="breadcrumb">
            <a href="<?php echo BASE_URL; ?>admin/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <span><i class="fas fa-chevron-right"></i></span>
            <span><?php echo $isEdit ? 'Modifier l\'événement' : 'Créer un événement'; ?></span>
        </nav>

        <!-- Form Card -->
        <div class="event-details-card">
            <div class="event-details-header">
                <h1>
                    <i class="fas fa-<?php echo $isEdit ? 'edit' : 'plus-circle'; ?>"></i>
                    <?php echo $isEdit ? 'Modifier l\'événement' : 'Créer un événement'; ?>
                </h1>

            </div>

            <div class="event-details-body">
                <form method="POST" enctype="multipart/form-data" class="event-form" id="eventForm">
                    <?php if ($isEdit && isset($event['id'])): ?>
                    <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="title">
                            <i class="fas fa-heading"></i> Titre de l'événement <span class="required">*</span>
                        </label>
                        <input type="text" id="title" name="title"
                            value="<?php echo htmlspecialchars($event['title'] ?? ''); ?>"
                            placeholder="Ex: Conférence Intelligence Artificielle 2025" required maxlength="255">
                    </div>


                    <div class="form-group">
                        <label for="description">
                            <i class="fas fa-align-left"></i> Description <span class="required">*</span>
                        </label>
                        <textarea id="description" name="description" rows="5"
                            placeholder="Décrivez votre événement en détail..."
                            required><?php echo htmlspecialchars($event['description'] ?? ''); ?></textarea>
                        <span class="field-hint">Décrivez le programme, les intervenants, les objectifs de
                            l'événement...</span>
                    </div>


                    <div class="form-row">
                        <div class="form-group">
                            <label for="event_date">
                                <i class="fas fa-calendar-alt"></i> Date <span class="required">*</span>
                            </label>
                            <input type="date" id="event_date" name="event_date"
                                value="<?php echo htmlspecialchars($event['event_date'] ?? ''); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="event_time">
                                <i class="fas fa-clock"></i> Heure <span class="required">*</span>
                            </label>
                            <input type="time" id="event_time" name="event_time"
                                value="<?php echo isset($event['event_time']) ? substr($event['event_time'], 0, 5) : ''; ?>"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="seats">
                                <i class="fas fa-users"></i> Places <span class="required">*</span>
                            </label>
                            <input type="number" id="seats" name="seats" min="1" max="10000"
                                value="<?php echo htmlspecialchars($event['seats'] ?? '25'); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="location">
                            <i class="fas fa-map-marker-alt"></i> Lieu <span class="required">*</span>
                        </label>
                        <input type="text" id="location" name="location"
                            value="<?php echo htmlspecialchars($event['location'] ?? ''); ?>"
                            placeholder="Ex: Amphi Laatiri-Sousse" required maxlength="255">
                    </div>


                    <div class="form-group">
                        <label>
                            <i class="fas fa-image"></i> Image de l'événement
                        </label>

                        <label class="custom-file">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span id="file-label-text">Cliquez pour sélectionner une image</span>
                            <input type="file" name="image" accept="image/*" hidden onchange="updateFileName(this)">
                        </label>
                        <span class="field-hint">Formats acceptés: JPG, PNG, GIF, WEBP. Taille max: 5MB</span>

                        <?php if ($isEdit && !empty($event['image']) && $event['image'] !== 'default.jpg'): ?>
                        <div class="current-image">
                            <p><i class="fas fa-image"></i> Image actuelle</p>
                            <img src="<?php echo BASE_URL; ?>uploads/<?php echo htmlspecialchars($event['image']); ?>"
                                alt="Image actuelle">
                        </div>
                        <?php endif; ?>
                    </div>


                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i>
                            <span><?php echo $isEdit ? 'Mettre à jour' : 'Créer l\'événement'; ?></span>
                        </button>
                        <a href="<?php echo BASE_URL; ?>admin/dashboard" class="btn btn-secondary btn-lg">
                            <i class="fas fa-times"></i>
                            <span>Annuler</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
function updateFileName(input) {
    const label = document.getElementById('file-label-text');
    if (input.files && input.files.length > 0) {
        label.textContent = input.files[0].name;
    } else {
        label.textContent = 'Cliquez pour sélectionner une image';
    }
}
</script>