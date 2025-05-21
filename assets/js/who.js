const input = document.getElementById('who');
input.addEventListener('input', () => {
  if (input.value < 1) input.value = '';
});