$(document).ready(function(){
  const fields = {
    defaultPage: $('#default-page'),
    emailNotifications: $('#email-notifications'),
    usageAnalytics: $('#usage-analytics'),
    profileVisibility: $('#profile-visibility'),
    compactNav: $('#compact-navigation')
  };

  function loadPreferences() {
    fields.defaultPage.val(localStorage.getItem('asms_default_page') || 'dashboard');
    fields.emailNotifications.prop('checked', localStorage.getItem('asms_email_notifications') === 'true');
    fields.usageAnalytics.prop('checked', localStorage.getItem('asms_usage_analytics') === 'true');
    fields.profileVisibility.prop('checked', localStorage.getItem('asms_profile_visibility') === 'true');
    fields.compactNav.prop('checked', localStorage.getItem('asms_compact_navigation') === 'true');
  }

  function savePreferences() {
    localStorage.setItem('asms_default_page', fields.defaultPage.val());
    localStorage.setItem('asms_email_notifications', fields.emailNotifications.is(':checked'));
    localStorage.setItem('asms_usage_analytics', fields.usageAnalytics.is(':checked'));
    localStorage.setItem('asms_profile_visibility', fields.profileVisibility.is(':checked'));
    localStorage.setItem('asms_compact_navigation', fields.compactNav.is(':checked'));
    Swal.fire('Saved', 'Your preferences were saved locally for a faster experience.', 'success');
  }

  if ($('#settings-preferences-form').length) {
    loadPreferences();
    $('#save-settings-preferences').on('click', function(e){
      e.preventDefault();
      savePreferences();
    });
  }
});
