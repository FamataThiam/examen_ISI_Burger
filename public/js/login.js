function switchTab(btn, tab) {
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('form-login').style.display    = tab === 'login'    ? '' : 'none';
    document.getElementById('form-register').style.display = tab === 'register' ? '' : 'none';
}
