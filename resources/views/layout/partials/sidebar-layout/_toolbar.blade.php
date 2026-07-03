<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
	<!--begin::Toolbar container-->
	<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
		@include(config('settings.KT_THEME_LAYOUT_DIR').'/partials/sidebar-layout/_page-title')
		<!--begin::Actions-->
		<div class="d-flex align-items-center gap-2 gap-lg-3">
			<!-- Notification Bell -->
			<div class="position-relative">
				<button class="btn btn-icon btn-sm btn-light-primary" id="notificationBell" data-bs-toggle="modal" data-bs-target="#notificationsModal" title="Notifications">
					<i class="bi bi-bell-fill fs-3 text-gray-500"></i>
					<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notificationBadge" style="display: none;">
						{{ ($unreadMessagesCount ?? 0) + ($notificationCount ?? 0) }}
					</span>
				</button>
			</div>
		</div>
		<!--end::Actions-->
	</div>
	<!--end::Toolbar container-->
</div>
<!--end::Toolbar-->

<!-- Notifications Modal -->
<div class="modal fade" id="notificationsModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header border-bottom">
				<h5 class="modal-title fw-bold">
					<i class="bi bi-bell-fill me-2 text-warning"></i>Notifications
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			<!-- Main List View -->
			<div id="notificationListView" class="modal-view">
				<div class="modal-body" style="max-height: 500px; overflow-y: auto;">
					<!-- Unread Messages Section -->
					<div id="messagesSection">
						<div class="mb-4">
							<div class="d-flex justify-content-between align-items-center mb-3">
								<h6 class="mb-0 fw-bold">
									<i class="bi bi-envelope-fill me-2 text-primary"></i>New Messages
								</h6>
								<span class="badge bg-primary" id="messageCount">0</span>
							</div>
							<div class="list-group" id="messagesListGroup">
								<!-- Messages loaded here (first 3) -->
							</div>
							<button type="button" class="btn btn-sm btn-outline-primary w-100 mt-2" id="btnViewAllMessages" style="display: none;">
								View All Messages
							</button>
						</div>

						<hr>
					</div>

					<!-- Pending Appointments Section -->
					<div id="appointmentsSection">
						<div class="mb-4">
							<div class="d-flex justify-content-between align-items-center mb-3">
								<h6 class="mb-0 fw-bold">
									<i class="bi bi-calendar-event me-2 text-success"></i>Pending Appointments
								</h6>
								<span class="badge bg-success" id="appointmentCount">0</span>
							</div>
							<div class="list-group" id="appointmentsListGroup">
								<!-- Appointments loaded here (first 3) -->
							</div>
							<button type="button" class="btn btn-sm btn-outline-success w-100 mt-2" id="btnViewAllAppointments" style="display: none;">
								View All Appointments
							</button>
						</div>
					</div>

					<!-- Empty State -->
					<div id="emptyState" class="text-center py-6" style="display: none;">
						<i class="bi bi-check-circle fs-2 text-success mb-3 d-block"></i>
						<p class="text-muted mb-0">No new notifications</p>
					</div>
				</div>

				<div class="modal-footer border-top">
					<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
				</div>
			</div>

			<!-- All Messages View -->
			<div id="allMessagesView" class="modal-view" style="display: none;">
				<div class="modal-header border-bottom">
					<h5 class="modal-title fw-bold">
						<i class="bi bi-arrow-left me-2"></i>
						<button type="button" class="btn btn-sm btn-outline-secondary" id="btnBackFromAllMessages" style="border: none; background: none; padding: 0; color: #3f6ce3;">
							<i class="bi bi-arrow-left me-1"></i>Back
						</button>
						All Unread Messages
					</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" style="max-height: 500px; overflow-y: auto;">
					<div id="allMessagesContainer" class="list-group">
						<!-- All messages loaded here -->
					</div>
				</div>
			</div>

			<!-- All Appointments View -->
			<div id="allAppointmentsView" class="modal-view" style="display: none;">
				<div class="modal-header border-bottom">
					<h5 class="modal-title fw-bold">
						<button type="button" class="btn btn-sm btn-outline-secondary" id="btnBackFromAllAppointments" style="border: none; background: none; padding: 0; color: #10b981;">
							<i class="bi bi-arrow-left me-1"></i>Back
						</button>
						All Pending Appointments
					</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body" style="max-height: 500px; overflow-y: auto;">
					<div id="allAppointmentsContainer" class="list-group">
						<!-- All appointments loaded here -->
					</div>
				</div>
			</div>

			<!-- Message Detail View -->
			<div id="messageDetailView" class="modal-view" style="display: none;">
				<div class="modal-body p-4" style="max-height: 500px; overflow-y: auto;">
					<button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="btnBackFromMessage">
						<i class="bi bi-arrow-left me-1"></i>Back
					</button>

					<div class="card border-0 bg-light-info p-4 mb-3">
						<div class="row mb-3">
							<div class="col-sm-6">
								<small class="text-muted fw-bold">Name:</small>
								<p class="mb-0" id="msgDetailName">-</p>
							</div>
							<div class="col-sm-6">
								<small class="text-muted fw-bold">Email:</small>
								<p class="mb-0" id="msgDetailEmail">-</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<small class="text-muted fw-bold">Phone:</small>
								<p class="mb-0" id="msgDetailPhone">-</p>
							</div>
							<div class="col-sm-6">
								<small class="text-muted fw-bold">Date:</small>
								<p class="mb-0" id="msgDetailDate">-</p>
							</div>
						</div>
					</div>

					<div class="card border-0 mb-3">
						<div class="card-body">
							<h6 class="card-title fw-bold mb-3" id="msgDetailSubject">-</h6>
							<p class="card-text text-muted" id="msgDetailContent" style="white-space: pre-wrap; word-wrap: break-word;">-</p>
						</div>
					</div>
				</div>

				<div class="modal-footer border-top">
					<button type="button" class="btn btn-secondary btn-sm" id="btnCloseFromMessage" data-bs-dismiss="modal">Close</button>
				</div>
			</div>

			<!-- Appointment Detail View -->
			<div id="appointmentDetailView" class="modal-view" style="display: none;">
				<div class="modal-body p-4" style="max-height: 500px; overflow-y: auto;">
					<button type="button" class="btn btn-sm btn-outline-secondary mb-3" id="btnBackToList">
						<i class="bi bi-arrow-left me-1"></i>Back
					</button>

					<div class="card border-0 bg-light-success p-4 mb-3">
						<div class="row mb-3">
							<div class="col-sm-6">
								<small class="text-muted fw-bold">Patient Name:</small>
								<p class="mb-0" id="detailName">-</p>
							</div>
							<div class="col-sm-6">
								<small class="text-muted fw-bold">Email:</small>
								<p class="mb-0" id="detailEmail">-</p>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<small class="text-muted fw-bold">Phone:</small>
								<p class="mb-0" id="detailPhone">-</p>
							</div>
						</div>
					</div>

					<div class="card border-0 mb-3">
						<div class="card-body">
							<h6 class="card-title fw-bold mb-3">Appointment Details</h6>
							<div class="row mb-3">
								<div class="col-sm-6">
									<small class="text-muted fw-bold">Service:</small>
									<p class="mb-0" id="detailService">-</p>
								</div>
								<div class="col-sm-6">
									<small class="text-muted fw-bold">Doctor:</small>
									<p class="mb-0" id="detailDoctor">-</p>
								</div>
							</div>
							<div class="row mb-3">
								<div class="col-sm-6">
									<small class="text-muted fw-bold">Date:</small>
									<p class="mb-0" id="detailDate">-</p>
								</div>
								<div class="col-sm-6">
									<small class="text-muted fw-bold">Time:</small>
									<p class="mb-0" id="detailTime">-</p>
								</div>
							</div>
							<div id="messageSection" style="display: none;">
								<small class="text-muted fw-bold">Message:</small>
								<p class="text-muted mb-0" id="detailMessage" style="white-space: pre-wrap; word-wrap: break-word;">-</p>
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer border-top">
					<button type="button" class="btn btn-secondary btn-sm" id="btnCloseDetail" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary btn-sm" id="btnHandleAppointment" data-bs-toggle="modal" data-bs-target="#handleAppointmentModal">Handle Appointment</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Handle Appointment Modal -->
<div class="modal fade" id="handleAppointmentModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header border-bottom">
				<h5 class="modal-title fw-bold">Handle Appointment</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="card border-0 bg-light-info p-3 mb-3">
					<div class="row mb-2">
						<div class="col-sm-6">
							<small class="text-muted fw-bold">Patient:</small>
							<p class="mb-0" id="handleName">-</p>
						</div>
						<div class="col-sm-6">
							<small class="text-muted fw-bold">Email:</small>
							<p class="mb-0" id="handleEmail">-</p>
						</div>
					</div>
					<div class="row mb-2">
						<div class="col-sm-6">
							<small class="text-muted fw-bold">Phone:</small>
							<p class="mb-0" id="handlePhone">-</p>
						</div>
						<div class="col-sm-6">
							<small class="text-muted fw-bold">Service:</small>
							<p class="mb-0" id="handleService">-</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<small class="text-muted fw-bold">Doctor:</small>
							<p class="mb-0" id="handleDoctor">-</p>
						</div>
						<div class="col-sm-6">
							<small class="text-muted fw-bold">Date & Time:</small>
							<p class="mb-0" id="handleDateTime">-</p>
						</div>
					</div>
				</div>

				<form id="handleAppointmentForm">
					<div class="mb-3">
						<label class="form-label fw-bold">Update Status</label>
						<select class="form-select" id="appointmentStatus" name="status" required>
							<option value="pending">Pending</option>
							<option value="confirmed">Confirmed</option>
							<option value="completed">Completed</option>
							<option value="cancelled">Cancelled</option>
						</select>
					</div>

					<div class="mb-3">
						<label class="form-label fw-bold">Admin Notes</label>
						<textarea class="form-control" id="adminNotes" name="admin_notes" rows="3" placeholder="Add notes about this appointment..."></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer border-top">
				<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary btn-sm" id="btnSaveAppointment">Save Changes</button>
			</div>
		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	let currentAppointmentData = null;
	let currentMessageData = null;

	// Show/hide modal views
	function showView(viewId) {
		document.querySelectorAll('.modal-view').forEach(v => v.style.display = 'none');
		document.getElementById(viewId).style.display = 'block';
	}

	// Initialize badge display on page load
	function initializeNotificationBadge() {
		const badge = document.getElementById('notificationBadge');
		const badgeCount = parseInt(badge.textContent) || 0;
		
		if (badgeCount > 0) {
			badge.style.display = 'block';
		} else {
			badge.style.display = 'none';
		}
	}

	// Load notifications when modal opens
	const notificationsModal = document.getElementById('notificationsModal');
	notificationsModal.addEventListener('show.bs.modal', function() {
		// Reset to main notification list view
		showView('notificationListView');
		loadNotifications();
	});

	// Reset view when modal is hidden
	notificationsModal.addEventListener('hide.bs.modal', function() {
		showView('notificationListView');
	});

	// Load all notifications (messages and appointments)
	function loadNotifications() {
		loadMessages();
		loadAppointments();
	}

	// Update notification badge
	function updateNotificationBadge() {
		const messageCount = parseInt(document.getElementById('messageCount').textContent) || 0;
		const appointmentCount = parseInt(document.getElementById('appointmentCount').textContent) || 0;
		const totalCount = messageCount + appointmentCount;
		const badge = document.getElementById('notificationBadge');

		if (totalCount > 0) {
			badge.textContent = totalCount;
			badge.style.display = 'block';
		} else {
			badge.style.display = 'none';
		}
	}

	// Load unread messages
	function loadMessages() {
		fetch('/admin/contact-messages?filter=unread&ajax=true', {
			headers: {
				'X-Requested-With': 'XMLHttpRequest',
				'Accept': 'application/json'
			}
		})
		.then(response => response.json())
		.then(data => {
			const messagesContainer = document.getElementById('messagesListGroup');
			const messageCount = document.getElementById('messageCount');
			const messagesSection = document.getElementById('messagesSection');
			const btnViewAllMessages = document.getElementById('btnViewAllMessages');

			if (data.messages && data.messages.length > 0) {
				messageCount.textContent = data.messages.length;
				messagesSection.style.display = 'block';

				// Show only first 3 messages
				let html = '';
				data.messages.slice(0, 3).forEach(msg => {
					html += `
						<div class="list-group-item p-3 border-0 mb-2 rounded message-item" 
							 data-id="${msg.id}"
							 data-name="${msg.name}"
							 data-email="${msg.email}"
							 data-phone="${msg.phone || 'N/A'}"
							 data-subject="${msg.subject}"
							 data-content="${msg.message}"
							 data-date="${msg.created_at}"
							 style="background-color: #f8f9ff; border-left: 3px solid #3f6ce3; cursor: pointer;">
							<div class="d-flex justify-content-between align-items-start">
								<div class="flex-grow-1">
									<h6 class="mb-1 fw-bold text-gray-900">${msg.name}</h6>
									<p class="mb-1 text-muted small">${msg.subject.substring(0, 50)}</p>
									<p class="mb-0 text-muted small">${msg.message.substring(0, 60)}</p>
								</div>
								<small class="text-muted ms-2 text-nowrap">${msg.time_ago}</small>
							</div>
						</div>
					`;
				});
				messagesContainer.innerHTML = html;

				// Show "View All" button if more than 3 messages
				if (data.messages.length > 3) {
					btnViewAllMessages.style.display = 'block';
				} else {
					btnViewAllMessages.style.display = 'none';
				}

				checkEmptyState();
				updateNotificationBadge();
			} else {
				messagesSection.style.display = 'none';
				messageCount.textContent = '0';
				btnViewAllMessages.style.display = 'none';
				checkEmptyState();
				updateNotificationBadge();
			}
		})
		.catch(error => {
			console.error('Error loading messages:', error);
		});
	}

	// Load pending appointments
	function loadAppointments() {
		fetch('/admin/appointments?filter=pending&ajax=true', {
			headers: {
				'X-Requested-With': 'XMLHttpRequest',
				'Accept': 'application/json'
			}
		})
		.then(response => response.json())
		.then(data => {
			const appointmentsContainer = document.getElementById('appointmentsListGroup');
			const appointmentCount = document.getElementById('appointmentCount');
			const appointmentsSection = document.getElementById('appointmentsSection');
			const btnViewAllAppointments = document.getElementById('btnViewAllAppointments');

			if (data.appointments && data.appointments.length > 0) {
				appointmentCount.textContent = data.appointments.length;
				appointmentsSection.style.display = 'block';

				// Show only first 3 appointments
				let html = '';
				data.appointments.slice(0, 3).forEach(appt => {
					html += `
						<div class="list-group-item p-3 border-0 mb-2 rounded appointment-item" 
							 data-id="${appt.id}"
							 data-name="${appt.name}"
							 data-email="${appt.email}"
							 data-phone="${appt.phone}"
							 data-service="${appt.service}"
							 data-doctor="${appt.doctor}"
							 data-date="${appt.date}"
							 data-time="${appt.time}"
							 data-message="${appt.message || ''}"
							 style="background-color: #f0fdf4; border-left: 3px solid #10b981; cursor: pointer;">
							<div class="d-flex justify-content-between align-items-start">
								<div class="flex-grow-1">
									<h6 class="mb-1 fw-bold text-gray-900">${appt.name}</h6>
									<p class="mb-1 text-muted small">
										<i class="bi bi-calendar-event me-1"></i>${appt.service}
									</p>
									<p class="mb-0 text-muted small">
										<i class="bi bi-clock me-1"></i>${appt.date} at ${appt.time}
									</p>
								</div>
								<small class="text-muted ms-2 text-nowrap">${appt.time_ago}</small>
							</div>
						</div>
					`;
				});
				appointmentsContainer.innerHTML = html;

				// Show "View All" button if more than 3 appointments
				if (data.appointments.length > 3) {
					btnViewAllAppointments.style.display = 'block';
				} else {
					btnViewAllAppointments.style.display = 'none';
				}

				checkEmptyState();
				updateNotificationBadge();
			} else {
				appointmentsSection.style.display = 'none';
				appointmentCount.textContent = '0';
				btnViewAllAppointments.style.display = 'none';
				checkEmptyState();
				updateNotificationBadge();
			}
		})
		.catch(error => {
			console.error('Error loading appointments:', error);
		});
	}

	// Check if empty state should be shown
	function checkEmptyState() {
		const messagesSection = document.getElementById('messagesSection');
		const appointmentsSection = document.getElementById('appointmentsSection');
		const emptyState = document.getElementById('emptyState');

		const hasMessages = messagesSection.style.display !== 'none' && document.getElementById('messagesListGroup').children.length > 0;
		const hasAppointments = appointmentsSection.style.display !== 'none' && document.getElementById('appointmentsListGroup').children.length > 0;

		if (!hasMessages && !hasAppointments) {
			emptyState.style.display = 'block';
		} else {
			emptyState.style.display = 'none';
		}
	}

	// Click on message item
	document.addEventListener('click', function(e) {
		const messageItem = e.target.closest('.message-item');
		if (messageItem) {
			currentMessageData = {
				id: messageItem.getAttribute('data-id'),
				name: messageItem.getAttribute('data-name'),
				email: messageItem.getAttribute('data-email'),
				phone: messageItem.getAttribute('data-phone'),
				subject: messageItem.getAttribute('data-subject'),
				content: messageItem.getAttribute('data-content'),
				date: messageItem.getAttribute('data-date')
			};

			// Populate message detail view
			document.getElementById('msgDetailName').textContent = currentMessageData.name;
			document.getElementById('msgDetailEmail').textContent = currentMessageData.email;
			document.getElementById('msgDetailPhone').textContent = currentMessageData.phone;
			document.getElementById('msgDetailDate').textContent = currentMessageData.date;
			document.getElementById('msgDetailSubject').textContent = currentMessageData.subject;
			document.getElementById('msgDetailContent').textContent = currentMessageData.content;

			showView('messageDetailView');

			// Automatically mark message as read
			markMessageAsRead(currentMessageData.id);
		}
	});

	// Click on appointment item
	document.addEventListener('click', function(e) {
		const appointmentItem = e.target.closest('.appointment-item');
		if (appointmentItem) {
			currentAppointmentData = {
				id: appointmentItem.getAttribute('data-id'),
				name: appointmentItem.getAttribute('data-name'),
				email: appointmentItem.getAttribute('data-email'),
				phone: appointmentItem.getAttribute('data-phone'),
				service: appointmentItem.getAttribute('data-service'),
				doctor: appointmentItem.getAttribute('data-doctor'),
				date: appointmentItem.getAttribute('data-date'),
				time: appointmentItem.getAttribute('data-time'),
				message: appointmentItem.getAttribute('data-message')
			};

			// Populate detail view
			document.getElementById('detailName').textContent = currentAppointmentData.name;
			document.getElementById('detailEmail').textContent = currentAppointmentData.email;
			document.getElementById('detailPhone').textContent = currentAppointmentData.phone;
			document.getElementById('detailService').textContent = currentAppointmentData.service;
			document.getElementById('detailDoctor').textContent = currentAppointmentData.doctor;
			document.getElementById('detailDate').textContent = currentAppointmentData.date;
			document.getElementById('detailTime').textContent = currentAppointmentData.time;

			// Show message if exists
			if (currentAppointmentData.message && currentAppointmentData.message.trim() !== '') {
				document.getElementById('detailMessage').textContent = currentAppointmentData.message;
				document.getElementById('messageSection').style.display = 'block';
			} else {
				document.getElementById('messageSection').style.display = 'none';
			}

			showView('appointmentDetailView');

			// Automatically mark appointment as seen
			markAppointmentAsSeen(currentAppointmentData.id);
		}
	});

	// Mark message as read
	function markMessageAsRead(messageId) {
		fetch(`/admin/contact-messages/${messageId}/mark-as-read`, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
			}
		})
		.then(response => response.json())
		.then(data => {
			if (data.success) {
				console.log('Message marked as read:', messageId);
				// Reload notifications to update count
				loadNotifications();
			}
		})
		.catch(error => console.error('Error marking message as read:', error));
	}

	// Mark appointment as seen
	function markAppointmentAsSeen(appointmentId) {
		fetch(`/admin/appointments/${appointmentId}/mark-as-seen`, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
				'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
			}
		})
		.then(response => response.json())
		.then(data => {
			if (data.success) {
				console.log('Appointment marked as seen:', appointmentId);
				// Reload notifications to update count
				loadNotifications();
			}
		})
		.catch(error => console.error('Error marking appointment as seen:', error));
	}

	// Back buttons
	document.getElementById('btnBackFromMessage').addEventListener('click', function() {
		showView('notificationListView');
	});

	document.getElementById('btnBackToList').addEventListener('click', function() {
		showView('notificationListView');
	});

	document.getElementById('btnCloseDetail').addEventListener('click', function() {
		showView('notificationListView');
	});

	// View All Messages button
	document.getElementById('btnViewAllMessages').addEventListener('click', function() {
		showView('allMessagesView');
		const container = document.getElementById('allMessagesContainer');
		container.innerHTML = '<div class="text-center p-4"><div class="spinner-border spinner-border-sm" role="status"></div></div>';

		fetch('/admin/contact-messages?filter=unread&ajax=true', {
			headers: {
				'X-Requested-With': 'XMLHttpRequest',
				'Accept': 'application/json'
			}
		})
		.then(response => response.json())
		.then(data => {
			if (data.messages && data.messages.length > 0) {
				let html = '';
				data.messages.forEach(msg => {
					html += `
						<div class="list-group-item p-3 border-0 mb-2 rounded message-item" 
							 data-id="${msg.id}"
							 data-name="${msg.name}"
							 data-email="${msg.email}"
							 data-phone="${msg.phone || 'N/A'}"
							 data-subject="${msg.subject}"
							 data-content="${msg.message}"
							 data-date="${msg.created_at}"
							 style="background-color: #f8f9ff; border-left: 3px solid #3f6ce3; cursor: pointer;">
							<div class="d-flex justify-content-between align-items-start">
								<div class="flex-grow-1">
									<h6 class="mb-1 fw-bold text-gray-900">${msg.name}</h6>
									<p class="mb-1 text-muted small">${msg.subject.substring(0, 50)}</p>
									<p class="mb-0 text-muted small">${msg.message.substring(0, 60)}</p>
								</div>
								<small class="text-muted ms-2 text-nowrap">${msg.time_ago}</small>
							</div>
						</div>
					`;
				});
				container.innerHTML = html;
			} else {
				container.innerHTML = '<div class="text-center py-10"><p class="text-muted">No unread messages</p></div>';
			}
		})
		.catch(error => {
			console.error('Error loading all messages:', error);
			container.innerHTML = '<div class="text-center py-10"><p class="text-danger">Error loading messages</p></div>';
		});
	});

	// View All Appointments button
	document.getElementById('btnViewAllAppointments').addEventListener('click', function() {
		showView('allAppointmentsView');
		const container = document.getElementById('allAppointmentsContainer');
		container.innerHTML = '<div class="text-center p-4"><div class="spinner-border spinner-border-sm" role="status"></div></div>';

		fetch('/admin/appointments?filter=pending&ajax=true', {
			headers: {
				'X-Requested-With': 'XMLHttpRequest',
				'Accept': 'application/json'
			}
		})
		.then(response => response.json())
		.then(data => {
			if (data.appointments && data.appointments.length > 0) {
				let html = '';
				data.appointments.forEach(appt => {
					html += `
						<div class="list-group-item p-3 border-0 mb-2 rounded appointment-item" 
							 data-id="${appt.id}"
							 data-name="${appt.name}"
							 data-email="${appt.email}"
							 data-phone="${appt.phone}"
							 data-service="${appt.service}"
							 data-doctor="${appt.doctor}"
							 data-date="${appt.date}"
							 data-time="${appt.time}"
							 data-message="${appt.message || ''}"
							 style="background-color: #f0fdf4; border-left: 3px solid #10b981; cursor: pointer;">
							<div class="d-flex justify-content-between align-items-start">
								<div class="flex-grow-1">
									<h6 class="mb-1 fw-bold text-gray-900">${appt.name}</h6>
									<p class="mb-1 text-muted small">
										<i class="bi bi-calendar-event me-1"></i>${appt.service}
									</p>
									<p class="mb-0 text-muted small">
										<i class="bi bi-clock me-1"></i>${appt.date} at ${appt.time}
									</p>
								</div>
								<small class="text-muted ms-2 text-nowrap">${appt.time_ago}</small>
							</div>
						</div>
					`;
				});
				container.innerHTML = html;
			} else {
				container.innerHTML = '<div class="text-center py-10"><p class="text-muted">No pending appointments</p></div>';
			}
		})
		.catch(error => {
			console.error('Error loading all appointments:', error);
			container.innerHTML = '<div class="text-center py-10"><p class="text-danger">Error loading appointments</p></div>';
		});
	});

	// Back buttons from all views
	document.getElementById('btnBackFromAllMessages').addEventListener('click', function() {
		showView('notificationListView');
	});

	document.getElementById('btnBackFromAllAppointments').addEventListener('click', function() {
		showView('notificationListView');
	});

	// Handle Appointment button - open handle modal
	document.getElementById('btnHandleAppointment').addEventListener('click', function() {
		if (currentAppointmentData) {
			// Populate handle modal
			document.getElementById('handleName').textContent = currentAppointmentData.name;
			document.getElementById('handleEmail').textContent = currentAppointmentData.email;
			document.getElementById('handlePhone').textContent = currentAppointmentData.phone;
			document.getElementById('handleService').textContent = currentAppointmentData.service;
			document.getElementById('handleDoctor').textContent = currentAppointmentData.doctor;
			document.getElementById('handleDateTime').textContent = `${currentAppointmentData.date} at ${currentAppointmentData.time}`;

			// Reset form
			document.getElementById('appointmentStatus').value = 'pending';
			document.getElementById('adminNotes').value = '';
		}
	});

	// Save appointment changes
	document.getElementById('btnSaveAppointment').addEventListener('click', function() {
		if (!currentAppointmentData) {
			alert('No appointment selected');
			return;
		}

		const status = document.getElementById('appointmentStatus').value;
		const adminNotes = document.getElementById('adminNotes').value;
		const appointmentId = currentAppointmentData.id;

		// Send update to server
		fetch(`/admin/appointments/${appointmentId}/handle`, {
			method: 'PUT',
			headers: {
				'Content-Type': 'application/json',
				'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
			},
			body: JSON.stringify({
				status: status,
				admin_notes: adminNotes
			})
		})
		.then(response => {
			if (!response.ok) {
				throw new Error(`HTTP error! status: ${response.status}`);
			}
			return response.json();
		})
		.then(data => {
			if (data.success) {
				// Close modals
				const handleModal = bootstrap.Modal.getInstance(document.getElementById('handleAppointmentModal'));
				const notificationModal = bootstrap.Modal.getInstance(document.getElementById('notificationsModal'));
				
				if (handleModal) handleModal.hide();
				if (notificationModal) notificationModal.hide();

				alert('Appointment updated successfully');
				
				// Reload page after 1 second
				setTimeout(() => location.reload(), 1000);
			} else {
				alert('Error: ' + (data.message || 'Failed to update appointment'));
			}
		})
		.catch(error => {
			console.error('Error:', error);
			alert('Error updating appointment: ' + error.message);
		});
	});

	// Initialize notification badge on page load
	initializeNotificationBadge();
});
</script>
