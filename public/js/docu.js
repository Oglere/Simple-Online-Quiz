function toggleVisibility(elementId, show) {
    const element = document.getElementById(elementId);
    element.classList.toggle("hidden", !show);
  }
  
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
      const name = `${row.children[1].textContent.toLowerCase()}`;
      const email = row.children[3].textContent.toLowerCase();
      const userRole = row.children[2].textContent;
  
      const matchesSearch =
        name.includes(searchQuery) || email.includes(searchQuery);
      const matchesRole = role === "all" || userRole === role;
  
      row.style.display = matchesSearch && matchesRole ? "" : "none";
    });
  }
  
  document.addEventListener("DOMContentLoaded", () => {
      const modal = document.getElementById("delete-modal");
      const form = document.getElementById("delete-user-form");
      const userIdInput = document.getElementById("delete-user-id");
      const modalText = modal.querySelector("p");
      const modalTitle = modal.querySelector("h2");
      const cancelBtn = document.getElementById("cancel-delete");

      const confirmBtn = document.getElementById("confirm-delete");

      // Dynamically handle the modal open per button type
      document.querySelectorAll(".permdelt, .recover, .delete").forEach(button => {
          button.addEventListener("click", (event) => {
              handleDelete(event);
              const docId = button.dataset.id;

              // Change modal text and form action depending on button type
              if (button.classList.contains("permdelt")) {
                actionType = "permdelt";
                modalText.textContent = "Are you sure you want to permanently delete this document?";
                modalTitle.textContent = "Confirm Permanent Deletion";
                modalTitle.style.color = "black";
                form.action = `/admin/storage/${docId}/3`;
              } 
              
              else if (button.classList.contains("recover")) {
                actionType = "recover";
                modalText.textContent = "Recover this document?";
                modalTitle.textContent = "Confirm Recover";
                modalTitle.style.color = "Orange";
                form.action = `/admin/storage/${docId}/2`;
              } 
              
              else if (button.classList.contains("delete")) {
                actionType = "delete";
                modalTitle.textContent = "Confirm Deletion";
                modalText.textContent = "Are you sure you want to delete this document?";
                modalTitle.style.color = "#8e0404";
                form.action = `/admin/storage/${docId}/1`;
              }

              userIdInput.value = docId;
              modal.classList.remove("hidden");
          });
      });

      // Cancel the modal
      cancelBtn.addEventListener("click", () => {
          modal.classList.add("hidden");
      });
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
  