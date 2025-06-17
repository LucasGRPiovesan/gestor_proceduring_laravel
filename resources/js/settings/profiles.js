const { default: axios } = require("axios");
const { default: Swal } = require("sweetalert2");
import { Modal } from 'bootstrap';

const columns = ['Profile', 'Description', 'Options'];
const storeModal = document.getElementById('exampleModal');
const updateEvent = document.getElementById('updateProfileBtn');
const loader = document.getElementById('loader');
const table = document.getElementById('profilesTable');
const perPage = document.getElementById('perPage');
const pagination = document.getElementById('pagination');
let currentPage = 1;

// INPUTS
const profileInput = document.getElementById('profileName');
const descriptionInput = document.getElementById('profileDescription');

let current = {}

const renderTable = (data) => {
  const thead = document.getElementById('profilesTableHead');
  const tbody = document.getElementById('profilesTableBody');

  thead.innerHTML = '';
  tbody.innerHTML = '';

  columns.forEach(column => {
    const th = document.createElement('th');
    th.scope = 'col';
    th.textContent = column;
    thead.appendChild(th);
  });

  data.forEach(profile => {
    const tr = document.createElement('tr');

    tr.innerHTML += `<td>${profile.profile}</td>`;
    tr.innerHTML += `<td>${profile.description}</td>`;
    tr.innerHTML += `
      <td>
        <button
          data-uuid="${profile.uuid}"
          type="button" 
          class="btn btn-primary fetch-profile"
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
          </svg>
        </button>
        <button
          data-uuid="${profile.uuid}" 
          type="button" 
          class="btn btn-danger delete-profile"
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
          </svg>
        </button>
      </td>
    `;

    tbody.appendChild(tr);
  });

  Array.from(document.getElementsByClassName('fetch-profile')).forEach(button => {
    button.addEventListener('click', () => {

      updateEvent.disabled = true;

      document.getElementById('updateProfileBtn').classList.remove('d-none');
      document.getElementById('createProfileBtn').classList.add('d-none');

      const uuid = button.dataset.uuid;
      fetchProfile(uuid);
    });
  });

  Array.from(document.getElementsByClassName('delete-profile')).forEach(button => {
    button.addEventListener('click', () => {
      const uuid = button.dataset.uuid;
      deleteProfile(uuid);
    });
  });
};

function listProfiles() {
  loader.classList.remove('d-none');
  table.classList.add('d-none');
  pagination.classList.add('d-none');

  axios.get('http://localhost:8000/api/profile', {
    params: {
      perPage: perPage.value || 5,
      page: currentPage || 1
    }
  })
    .then(response => {
      loader.classList.add('d-none');
      table.classList.remove('d-none');
      pagination.classList.remove('d-none');

      const { data, meta } = response.data;

      renderTable(data);
      renderPagination(meta.currentPage, meta.lastPage);
    })
    .catch(error => {
      console.error('Error fetching user data:', error);
    });
}

function fetchProfile(uuid) {  
  axios.get(`http://localhost:8000/api/profile/${uuid}`)
    .then(response => {
      const profile = response.data;
      current = profile;

      document.getElementById('profileName').value = profile.profile;
      document.getElementById('profileDescription').value = profile.description;

      const modal = Modal.getOrCreateInstance(storeModal);
      modal.show();
    })
    .catch(error => {
      console.error('Error fetching user data:', error);
    });
}

function updateProfile() {
  const payload = {}

  if (profileInput !== current.profile) payload.profile = profileInput.value
  if (descriptionInput !== current.description) payload.description = descriptionInput.value;

  axios.patch(`http://localhost:8000/api/profile/${current.uuid}`, payload)
    .then(() => {
      listProfiles();

      const modal = Modal.getOrCreateInstance(storeModal);
      modal.hide();

      Swal.fire({
        icon: 'success',
        title: `Profile ${profileInput.value} updated successfully!`,
      });

      cleanFields();
    })
    .catch(() => {
      Swal.fire({
        icon: 'error',
        title: `Error on update Profile ${profileInput.value}!`,
      });
    });
}

function deleteProfile(uuid) {  
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      axios.delete(`http://localhost:8000/api/profile/${uuid}`)
        .then(() => {
          currentPage = 1; // Reset to first page after deletion
          listProfiles();
          Swal.fire(
            'Deleted!',
            'Your profile has been deleted.',
            'success'
          );
        })
        .catch(() => {
          Swal.fire({
            icon: 'error',
            title: `Error on delete Profile!`,
          });
        });
    }
  });
}

function cleanFields() {
  document.getElementById('profileName').value = '';
  document.getElementById('profileDescription').value = '';
}

listProfiles();

document.getElementById('openModalBtn').addEventListener('click', () => {
  cleanFields();

  document.getElementById('createProfileBtn').classList.remove('d-none');
  document.getElementById('updateProfileBtn').classList.add('d-none');

  const modal = Modal.getOrCreateInstance(storeModal);
  modal.show();
});

document.getElementById('createProfileBtn').addEventListener('click', () => {
  const profile = document.getElementById('profileName').value;
  const description = document.getElementById('profileDescription').value;

  if (!profile || !description) {
    Swal.fire({
      icon: 'warning',
      title: 'All fields are required!',
    });

    return;
  }

  axios.post('http://localhost:8000/api/profile', {
    profile,
    description
  })
  .then(() => {
    listProfiles();

    const modal = Modal.getOrCreateInstance(storeModal);
    modal.hide();

    Swal.fire({
      icon: 'success',
      title: `Profile ${profile} created successfully!`,
    });

    cleanFields();
  })
  .catch(() => {

    Swal.fire({
      icon: 'error',
      title: `Error on create Profile ${profile}!`,
    });
  });
});


function checkForChanges() {
  const nameChanged = profileInput.value !== current.profile;
  const descChanged = descriptionInput.value !== current.description;

  console.log(nameChanged, descChanged);

  updateEvent.disabled = !(nameChanged || descChanged);
}

function getMaxPage() {
  const pageLinks = pagination.querySelectorAll('[data-page]');
  return pageLinks.length;
}

function highlightCurrentPage(page) {
  pagination.querySelectorAll('.page-item').forEach(li => li.classList.remove('active'));
  const currentItem = pagination.querySelector(`[data-page="${page}"]`);
  if (currentItem) currentItem.parentElement.classList.add('active');
}

function renderPagination(current, totalPages) {
  pagination.innerHTML = '';

  const prev = document.createElement('li');
  prev.className = 'page-item' + (current === 1 ? ' disabled' : '');
  prev.innerHTML = `
    <a class="page-link" href="#" data-action="prev" aria-label="Previous">
      <span aria-hidden="true">&laquo;</span>
    </a>`;
  pagination.appendChild(prev);

  for (let i = 1; i <= totalPages; i++) {
    const li = document.createElement('li');
    li.className = 'page-item' + (i === current ? ' active' : '');
    li.innerHTML = `<a class="page-link" href="#" data-page="${i}">${i}</a>`;
    pagination.appendChild(li);
  }

  const next = document.createElement('li');
  next.className = 'page-item' + (current === totalPages ? ' disabled' : '');
  next.innerHTML = `
    <a class="page-link" href="#" data-action="next" aria-label="Next">
      <span aria-hidden="true">&raquo;</span>
    </a>`;
  pagination.appendChild(next);
}

profileInput.addEventListener('input', checkForChanges);
descriptionInput.addEventListener('input', checkForChanges);

updateEvent.addEventListener('click', updateProfile);
perPage.addEventListener('change', listProfiles);

pagination.addEventListener('click', function (event) {
  event.preventDefault();

  const target = event.target.closest('.page-link');
  if (!target) return;

  const page = target.dataset.page;
  const action = target.dataset.action;

  let newPage = currentPage;

  if (page) {
    newPage = parseInt(page);
  } else if (action === 'prev') {
    newPage = Math.max(currentPage - 1, 1);
  } else if (action === 'next') {
    const maxPage = getMaxPage();
    newPage = Math.min(currentPage + 1, maxPage);
  }

  if (newPage === currentPage) return;
  currentPage = newPage;

  highlightCurrentPage(currentPage);
  listProfiles();
});
