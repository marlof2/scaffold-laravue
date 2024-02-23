import Vue from 'vue'

Vue.filter('cpf', (number) => {
  number = typeof number != 'string' ? number.toString() : number;
  number = number.replace(/\D/g,""); 
  number = number.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');

  return number;
})
