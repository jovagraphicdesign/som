$(document).ready(function () {
  $('#checkGDPRinschrijven').click(function () {
    console.log('clicked')
    $('#completeInschrijven').prop('disabled', !$('#checkGDPRinschrijven').prop('checked'))
  })

  $('#gdprChecksolliciteer').click(function () {
    console.log('clicked')
    $('#completeSolliciteer').prop('disabled', !$('#gdprChecksolliciteer').prop('checked'))
  })

  $('#gdprCheckContact').click(function () {
    console.log('clicked')
    $('#completeContact').prop('disabled', !$('#gdprCheckContact').prop('checked'))
  })

})
