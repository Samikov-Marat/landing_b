$('.alert__personal-information').on('click', () => {
  const faq_tab = $('.tab-alert__personal-information').closest('.faq-list__faq');
  if (!faq_tab.hasClass('faq-list__faq_opened')) {
    faq_tab.addClass('faq-list__faq_opened');
  }
  faq_tab.get(0).scrollIntoView();
})
