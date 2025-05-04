function toggleVisibility(elementId, show) {
  const element = document.getElementById(elementId);
  element.classList.toggle("hidden", !show);
}

document.getElementById("add-user-btn").addEventListener("click", () => {
  toggleVisibility("add-user-form", true);
  document.querySelector(".overlay").classList.remove("hidden");
});

document.getElementById("cancel-add").addEventListener("click", () => {
  toggleVisibility("add-user-form", false);
  toggleVisibility("user-list", true);
  document.querySelector(".overlay").classList.add("hidden");
});

document.querySelectorAll(".filter-btn").forEach((button) => {
  button.addEventListener("click", () => {
    const role = button.getAttribute("data-role");
    filterUsers(role);

    document.querySelectorAll(".filter-btn").forEach((btn) => {
      btn.classList.replace("btn-primary", "btn-secondary");
    });
    button.classList.replace("btn-secondary", "btn-primary");
  });
});

function filterUsers(role = "all") {
  const searchQuery = document.getElementById("search-bar").value.toLowerCase();
  const rows = document.querySelectorAll("tbody tr");

  rows.forEach((row) => {
    const name = `${row.children[1].textContent.toLowerCase()} ${row.children[2].textContent.toLowerCase()}`;
    const email = row.children[3].textContent.toLowerCase();
    const userRole = row.children[4].textContent;

    const matchesSearch =
      name.includes(searchQuery) || email.includes(searchQuery);
    const matchesRole = role === "all" || userRole === role;

    row.style.display = matchesSearch && matchesRole ? "" : "none";
  });
}

document.querySelector("tbody").addEventListener("click", (event) => {
  if (event.target.classList.contains("delete-btn")) {
    handleDelete(event);
  } else if (event.target.classList.contains("edit-btn")) {
    handleEdit(event);
  }
});

function handleDelete(event) {
  event.preventDefault(); 

  document.querySelector(".overlay").classList.remove("hidden");
  toggleVisibility("delete-modal", true);

  const userId = event.target.getAttribute("data-id");

  document.getElementById("delete-user-id").value = userId;

  document.getElementById("delete-user-form").action = `delete/${userId}`;

  document.getElementById("cancel-delete").onclick = () => {
    toggleVisibility("delete-modal", false);
    document.querySelector(".overlay").classList.add("hidden");
  };
} 

function handleEdit(event) {
  document.querySelector(".overlay").classList.remove("hidden");
  toggleVisibility("edit-modal", true);

  const userId = event.target.getAttribute("data-id");
  const row = document.querySelector(`tr[data-id="${userId}"]`);

  if (!row) {
    console.error(`No row found for user ID ${userId}`);
    return;
  }

  document.getElementById("edit-user_id").value = userId;  
  document.getElementById("edit-fname").value = row.children[1].textContent.trim();
  document.getElementById("edit-lname").value = row.children[2].textContent.trim();
  document.getElementById("edit-email").value = row.children[3].textContent.trim();
  document.getElementById("edit-role").value = row.children[4].textContent.trim();
  document.getElementById("edit-status").value = row.children[5].textContent.trim();

  document.getElementById("edit-user-form").action = `edit/${userId}`;

  document.getElementById("cancel-edit").onclick = () => {
    toggleVisibility("edit-modal", false);
    document.querySelector(".overlay").classList.add("hidden");
  };
}
