import CryptoJS from "crypto-js";

export default {
  descryptografar(textForDescrypted) {
    let decoded_encrypted = atob(textForDescrypted);

    let encrypted_json = JSON.parse(decoded_encrypted);

    var decrypted = CryptoJS.AES.decrypt(
      encrypted_json.value,
      CryptoJS.enc.Base64.parse(process.env.VUE_APP_KEY_CRYPTOGRAFIA),
      {
        iv: CryptoJS.enc.Base64.parse(encrypted_json.iv),
      }
    );

    var permissons = decrypted.toString(CryptoJS.enc.Utf8);

    return permissons;
  },

  cryptografarPeloFront(data) {
    var encrypted = CryptoJS.AES.encrypt(
      String(data),
      process.env.VUE_APP_KEY_CRYPTOGRAFIA
    );
    return encrypted;
  },

  descryptografarPeloFront(data) {
    var decrypted = CryptoJS.AES.decrypt(
      String(data),
      process.env.VUE_APP_KEY_CRYPTOGRAFIA
    );
    return decrypted.toString(CryptoJS.enc.Utf8);
  },
};
