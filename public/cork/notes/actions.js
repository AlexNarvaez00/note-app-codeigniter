const deleteNoteRequest = async (id) => {
  let request = await fetch(`/notes/${id}/`, {
    method: "DELETE", // or 'PUT'
    headers: {
      "Content-Type": "application/json",
    },
  }).then();
  let JSONResponse = await request.json();
  window.location.reload();
};

const deleteNote = (id) => {
  deleteNoteRequest(id);
};
