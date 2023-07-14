document.querySelector('.alert__personal-information').addEventListener('click', () => {
  const faq_tab = document.querySelector('.tab-alert__personal-information').closest('.faq-list__faq');

  if (!faq_tab.classList.contains('faq-list__faq_opened')) {
    faq_tab.classList.add('faq-list__faq_opened');
  }
  faq_tab.scrollIntoView();
})