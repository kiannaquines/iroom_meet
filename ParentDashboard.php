<?php
session_start();
include './backend/conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Parent Dashboard</title>
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

  <?php include './backend/includes/_header_parent.php'; ?>

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

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const eventsContainer = document.getElementById('events-container');
      const loadingDiv = document.getElementById('loading');

      function loadEvents() {
        fetch('backend/logic/event_crud.php?action=read')
          .then(response => response.json())
          .then(events => {
            loadingDiv.style.display = 'none';
            eventsContainer.innerHTML = '';

            if (events.length === 0) {
              eventsContainer.innerHTML = '<p class="text-muted text-center">No events found.</p>';
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
        `;
        eventsContainer.appendChild(newEventCard);
      }

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