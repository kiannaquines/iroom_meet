<?php
session_start();
include './backend/conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Adviser Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to bottom right, #e0f7fa, #b2ebf2);
      min-height: 100vh;
    }

    .profile-card {
      background: white;
      border-radius: 15px;
      padding: 15px;
      text-align: center;
    }

    .person_icon {
      width: 150px;
    }

    .event-card {
      background: #f1f8e9;
      border-left: 5px solid #4caf50;
      padding: 10px;
      margin-bottom: 10px;
    }

    button {
      background-color: #1ea004;
      color: black;
      padding: 5px;
      margin: none;
      border: none;
      cursor: pointer;
      border-radius: 5px;
    }

    .profile-edit .btn-primary {
      background-color: #1ea004;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      padding: 5px 10px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .profile-edit .btn-primary:hover {
      background-color: green;
    }

    button:hover {
      background-color: green;
      color: white;
      transition: background-color 0.3s ease;
    }

    .edit-event {
      background-color: #1ea004;
      color: black;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      width: 50px;
      height: 30px;
      font-size: 15px;
    }

    #add-event {
      background-color: #1ea004;
      color: white;
      border: none;
      border-radius: 5px;
      width: 150px;
      height: 50px;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s ease;
      display: block;
      margin: 20px auto;
      text-align: center;
    }

    #add-event:hover {
      background-color: green;
    }

    .loading {
      text-align: center;
      padding: 20px;
      color: #666;
    }

    .alert {
      margin-top: 10px;
    }
  </style>
</head>

<body class="container py-4">

  <?php include './backend/includes/_header.php'; ?>

  <div class="profile-card mb-4">
    <div class="mt-3">
      <img src="Pictures/person_icon.png" alt="person_icon" class="mb-2 person_icon" />
      <h6><?php echo ucfirst($_SESSION['username']); ?></h6>
      <p>Section</p>
      <div class="profile-edit">
        <a href="AdviserEdit.php" class="btn btn-primary">Edit</a>
      </div>
    </div>
  </div>

  <h5>Events</h5>
  <div id="loading" class="loading">Loading events...</div>
  <div id="events-container"></div>

  <button id="add-event" class="btn btn-primary mt-3">
    <i class="bi bi-plus"></i> Add Event
  </button>

  <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteConfirmModalLabel">Delete Event</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this event?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteEventBtn">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const eventsContainer = document.getElementById('events-container');
      const addEventButton = document.getElementById('add-event');
      const loadingDiv = document.getElementById('loading');
      let currentDeleteEventId = null;

      function loadEvents() {
        fetch('backend/logic/event_crud.php?action=read')
          .then(response => response.json())
          .then(events => {
            loadingDiv.style.display = 'none';
            eventsContainer.innerHTML = '';

            if (events.length === 0) {
              eventsContainer.innerHTML = '<p class="text-muted text-center">No events found. Click "Add Event" to create your first event.</p>';
              return;
            }

            events.forEach(event => {
              createEventCard(event);
            });
          })
          .catch(error => {
            loadingDiv.style.display = 'none';
            console.error('Error loading events:', error);
            showAlert('Error loading events', 'danger');
          });
      }

      function createEventCard(event) {
        const newEventCard = document.createElement('div');
        newEventCard.classList.add('event-card');
        newEventCard.setAttribute('data-event-id', event.id || 'new');

        var eventName = event.event_name || 'New Event';
        var eventWhat = event.event_what || '';
        var eventWhen = event.event_when || '';
        var eventWhere = event.event_where || '';
        var eventWho = event.event_who || '';

        newEventCard.innerHTML = `
          <div class="event-view-mode">
            <h6 class="event-title">${eventName}</h6>
            <p class="event-details">
              <strong>What:</strong> <span class="event-what">${eventWhat}</span><br />
              <strong>When:</strong> <span class="event-when">${eventWhen}</span><br />
              <strong>Where:</strong> <span class="event-where">${eventWhere}</span><br />
              <strong>Who:</strong> <span class="event-who">${eventWho}</span>
            </p>
          </div>
          <div class="event-edit-mode" style="display: none;">
            <input type="text" class="form-control mb-2 event-name-input" 
             placeholder="Event Name" value="${event.event_name || ''}">
            <input type="text" class="form-control mb-2 event-what-input" 
                  placeholder="What" value="${event.event_what || ''}">
            <input type="text" class="form-control mb-2 event-when-input" 
                  placeholder="When" value="${event.event_when || ''}">
            <input type="text" class="form-control mb-2 event-where-input" 
                  placeholder="Where" value="${event.event_where || ''}">
            <input type="text" class="form-control mb-2 event-who-input" 
             placeholder="Who" value="${event.event_who || ''}">
          </div>
          <div class="d-flex justify-content-between align-items-end mt-2">
            <div>
              <button class="edit-event btn btn-primary btn-sm" type="button">Edit</button>
              <button class="save-event btn btn-success btn-sm" type="button" style="display: none;">Save</button>
              <button class="cancel-edit btn btn-secondary btn-sm" type="button" style="display: none;">Cancel</button>
            </div>
            <button class="delete-event btn btn-danger btn-sm" type="button">Delete</button>
          </div>
        `;

        eventsContainer.appendChild(newEventCard);
        setupEventCardHandlers(newEventCard);
      }

      function setupEventCardHandlers(card) {
        const editBtn = card.querySelector('.edit-event');
        const saveBtn = card.querySelector('.save-event');
        const cancelBtn = card.querySelector('.cancel-edit');
        const deleteBtn = card.querySelector('.delete-event');
        const viewMode = card.querySelector('.event-view-mode');
        const editMode = card.querySelector('.event-edit-mode');
        const eventId = card.getAttribute('data-event-id');

        editBtn.addEventListener('click', function() {
          viewMode.style.display = 'none';
          editMode.style.display = 'block';
          editBtn.style.display = 'none';
          saveBtn.style.display = 'inline-block';
          cancelBtn.style.display = 'inline-block';
          deleteBtn.style.display = 'none';
        });

        cancelBtn.addEventListener('click', function() {
          if (eventId === 'new') {
            card.remove();
          } else {
            viewMode.style.display = 'block';
            editMode.style.display = 'none';
            editBtn.style.display = 'inline-block';
            saveBtn.style.display = 'none';
            cancelBtn.style.display = 'none';
            deleteBtn.style.display = 'inline-block';
          }
        });

        saveBtn.addEventListener('click', function() {
          const eventData = {
            event_name: card.querySelector('.event-name-input').value,
            event_what: card.querySelector('.event-what-input').value,
            event_when: card.querySelector('.event-when-input').value,
            event_where: card.querySelector('.event-where-input').value,
            event_who: card.querySelector('.event-who-input').value
          };

          const formData = new FormData();
          formData.append('action', eventId === 'new' ? 'create' : 'update');

          for (const [key, value] of Object.entries(eventData)) {
            formData.append(key, value);
          }

          if (eventId !== 'new') {
            formData.append('id', eventId);
          }

          fetch('backend/logic/event_crud.php', {
              method: 'POST',
              body: formData
            })
            .then(response => response.json())
            .then(result => {
              console.log('Server response:', result);
              if (result.success) {
                showAlert(result.message, 'success');
                loadEvents();
              } else {
                showAlert(result.message || 'Failed to save event', 'danger');
              }
            })
            .catch(error => {
              console.error('Error saving event:', error);
              showAlert('Error saving event', 'danger');
            });
        });

        deleteBtn.addEventListener('click', function() {
          if (eventId === 'new') {
            card.remove();
            return;
          }

          currentDeleteEventId = eventId;
          const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
          deleteModal.show();
        });
      }

      document.getElementById('confirmDeleteEventBtn').addEventListener('click', function() {
        if (!currentDeleteEventId) return;

        const formData = new FormData();
        formData.append('action', 'delete');
        formData.append('id', currentDeleteEventId);

        fetch('backend/logic/event_crud.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(result => {
            if (result.success) {
              const eventCard = document.querySelector(`[data-event-id="${currentDeleteEventId}"]`);
              if (eventCard) eventCard.remove();
              showAlert(result.message, 'success');
            } else {
              showAlert(result.message, 'danger');
            }
          })
          .catch(error => {
            console.error('Error deleting event:', error);
            showAlert('Error deleting event', 'danger');
          })
          .finally(() => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteConfirmModal'));
            modal.hide();
            currentDeleteEventId = null;
          });
      });

      addEventButton.addEventListener('click', function() {
        const newEvent = {
          id: null,
          event_name: '',
          event_what: '',
          event_when: '',
          event_where: '',
          event_who: ''
        };

        createEventCard(newEvent);
      });

      function showAlert(message, type) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

        eventsContainer.insertBefore(alertDiv, eventsContainer.firstChild);

        setTimeout(() => {
          if (alertDiv.parentNode) {
            alertDiv.remove();
          }
        }, 5000);
      }

      loadEvents();
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>