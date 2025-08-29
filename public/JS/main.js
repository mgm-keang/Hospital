// Toggle sidebar open/closed
const toggle = document.querySelector('.toggle');
const navigation = document.querySelector('.navigation');
const main = document.querySelector('.main');
toggle.addEventListener('click', () => {
  navigation.classList.toggle('active');
  main.classList.toggle('active');
  // Change icon from menu to close (and vice versa)
  const icon = toggle.querySelector('.material-icons');
  if (navigation.classList.contains('active')) {
    icon.innerText = 'close';
  } else {
    icon.innerText = 'menu';
  }
});

// "Add User" button click (ripple effect + alert)
const addUserBtn = document.getElementById('addUserBtn');
if (addUserBtn) {
  addUserBtn.addEventListener('click', (e) => {
    e.preventDefault();
    // Create ripple element at click position
    const rect = addUserBtn.getBoundingClientRect();
    const ripple = document.createElement('span');
    ripple.className = 'ripple';
    const maxDim = Math.max(rect.width, rect.height);
    ripple.style.width = ripple.style.height = (maxDim * 2) + 'px';
    ripple.style.left = (e.clientX - rect.left - maxDim) + 'px';
    ripple.style.top = (e.clientY - rect.top - maxDim) + 'px';
    addUserBtn.appendChild(ripple);
    setTimeout(() => { ripple.remove(); }, 600);  // remove ripple after animation
    // Mock action (alert) after ripple effect
    setTimeout(() => {
      alert('Add new user – functionality not implemented.');
    }, 400);
  });
}

// Edit button functionality (mock)
document.querySelectorAll('.edit-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const row = btn.closest('tr');
    const name = row.querySelector('td').textContent;
    alert('Edit user "' + name + '" – functionality not implemented.');
  });
});

// Delete button functionality (mock with confirm)
document.querySelectorAll('.delete-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const row = btn.closest('tr');
    const name = row.querySelector('td').textContent;
    if (confirm('Are you sure you want to delete "' + name + '"?')) {
      row.remove();  // remove the row from table as a demonstration
    }
  });
});

// Optional: Card click feedback (each card is clickable)
document.querySelectorAll('.card').forEach(card => {
  card.addEventListener('click', () => {
    const title = card.querySelector('.cardName').innerText;
    alert(title + ' card was clicked (no further action).');
  });
});
