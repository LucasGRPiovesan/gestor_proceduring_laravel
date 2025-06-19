const { default: axios } = require("axios");
const { default: Swal } = require("sweetalert2");
import { Modal } from 'bootstrap';

const columns = ['Name', 'Profile', 'E-mail'];
const storeModal = document.getElementById('exampleModal');
const updateEvent = document.getElementById('updateUserBtn');
const loader = document.getElementById('loader');
const table = document.getElementById('usersTable');
const perPage = document.getElementById('perPage');
const pagination = document.getElementById('pagination');
let currentPage = 1;

// INPUTS
const nameInput = document.getElementById('userName');
const emailInput = document.getElementById('userEmail');
const profileSelect = document.getElementById('profile');

let current = {}

const renderTable = (data) => {
  const thead = document.getElementById('usersTableHead');
  const tbody = document.getElementById('usersTableBody');

  thead.innerHTML = '';
  tbody.innerHTML = '';

  columns.forEach(column => {
    const th = document.createElement('th');
    th.scope = 'col';
    th.textContent = column;
    thead.appendChild(th);
  });

  data.forEach(user => {
    const tr = document.createElement('tr');

    tr.innerHTML += `<td>${user.name}</td>`;
    tr.innerHTML += `
      <td>
        <span class="badge text-bg-primary">${user.profile.profile}</span>
      </td>
    `;
    tr.innerHTML += `<td>${user.email}</td>`;
    tr.innerHTML += `
      <td>
        <button
          data-uuid="${user.uuid}"
          type="button" 
          class="btn btn-primary fetch-user"
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
          </svg>
        </button>
        <button
          data-uuid="${user.uuid}" 
          type="button" 
          class="btn btn-danger delete-user"
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
          </svg>
        </button>
      </td>
    `;

    tbody.appendChild(tr);
  });

  Array.from(document.getElementsByClassName('fetch-user')).forEach(button => {
    button.addEventListener('click', () => {

      updateEvent.disabled = true;

      document.getElementById('updateUserBtn').classList.remove('d-none');
      document.getElementById('createUserBtn').classList.add('d-none');

      const uuid = button.dataset.uuid;
      fetchUser(uuid);
    });
  });

  Array.from(document.getElementsByClassName('delete-user')).forEach(button => {
    button.addEventListener('click', () => {
      const uuid = button.dataset.uuid;
      deleteProfile(uuid);
    });
  });
};

function listUsers() {
  loader.classList.remove('d-none');
  table.classList.add('d-none');
  pagination.classList.add('d-none');

  axios.get('http://localhost:8000/api/user', {
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

function loadProfiles() {
  axios.get('http://localhost:8000/api/profile-select')
    .then(response => {
      const select = document.getElementById('profile');
      // select.innerHTML = '';

      response.data.forEach(profile => {
        const option = document.createElement('option');
        option.value = profile.value;
        option.textContent = profile.label;
        select.appendChild(option);
      });
    })
    .catch(error => {
      console.error('Error fetching profiles:', error);
    });
}

function fetchUser(uuid) {  

  document.querySelectorAll('.only-create').forEach(el => {
    el.classList.add('d-none');
  });

  axios.get(`http://localhost:8000/api/user/${uuid}`)
    .then(response => {
      const user = response.data;
      current = user;

      document.getElementById('userName').value = user.name;
      document.getElementById('userEmail').value = user.email;
      document.getElementById('profile').value = user.profile.uuid;

      const modal = Modal.getOrCreateInstance(storeModal);
      modal.show();
    })
    .catch(error => {
      console.error('Error fetching user data:', error);
    });
}

function updateUser() {
  const payload = {}

  if (nameInput.value !== current.name) payload.name = nameInput.value;
  if (emailInput.value !== current.email) payload.email = emailInput.value;
  if (profileSelect.value !== current.uuid_profile) payload.uuid_profile = profileSelect.value;
  
  axios.patch(`http://localhost:8000/api/user/${current.uuid}`, payload)
    .then(() => {
      listUsers();

      const modal = Modal.getOrCreateInstance(storeModal);
      modal.hide();

      Swal.fire({
        icon: 'success',
        title: `User ${nameInput.value} updated successfully!`,
      });

      cleanFields();
    })
    .catch(() => {
      Swal.fire({
        icon: 'error',
        title: `Error on update Profile ${nameInput.value}!`,
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
      axios.delete(`http://localhost:8000/api/user/${uuid}`)
        .then(() => {
          currentPage = 1; // Reset to first page after deletion
          listUsers();
          Swal.fire(
            'Deleted!',
            'User has been deleted.',
            'success'
          );
        })
        .catch(() => {
          Swal.fire({
            icon: 'error',
            title: `Error on delete User!`,
          });
        });
    }
  });
}

function cleanFields() {
  document.getElementById('userName').value = '';
  document.getElementById('userEmail').value = '';
  document.getElementById('profile').value = '';
  document.getElementById('userPassword').value = '';
}

listUsers();
loadProfiles();

document.getElementById('openModalBtn').addEventListener('click', () => {
  cleanFields();

  document.getElementById('createUserBtn').classList.remove('d-none');
  document.getElementById('updateUserBtn').classList.add('d-none');

  document.querySelectorAll('.only-create').forEach(el => {
    el.classList.remove('d-none');
  });

  const modal = Modal.getOrCreateInstance(storeModal);
  modal.show();
});

document.getElementById('createUserBtn').addEventListener('click', () => {
  const name = document.getElementById('userName').value;
  const email = document.getElementById('userEmail').value;
  const uuid_profile = document.getElementById('profile').value;
  const password = document.getElementById('userPassword').value;

  if (!name || !email || !uuid_profile || !password) {
    Swal.fire({
      icon: 'warning',
      title: 'All fields are required!',
    });

    return;
  }

  axios.post('http://localhost:8000/api/user', {
    name,
    email,
    uuid_profile,
    password
  })
  .then(() => {
    listUsers();

    const modal = Modal.getOrCreateInstance(storeModal);
    modal.hide();

    Swal.fire({
      icon: 'success',
      title: `User ${name} created successfully!`,
    });

    cleanFields();
  })
  .catch(() => {

    Swal.fire({
      icon: 'error',
      title: `Error on create User ${name}!`,
    });
  });
});


function checkForChanges() {  
  const nameChanged = nameInput.value !== current.name;
  const emailChanged = emailInput.value !== current.email;
  const profileChanged = profileSelect.value !== current.uuid_profile;

  updateEvent.disabled = !(nameChanged || emailChanged || profileChanged);
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

nameInput.addEventListener('input', checkForChanges);
emailInput.addEventListener('input', checkForChanges);
profileSelect.addEventListener('change', checkForChanges);

updateEvent.addEventListener('click', updateUser);
perPage.addEventListener('change', listUsers);

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
  listUsers();
});
