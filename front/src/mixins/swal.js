import { color } from "echarts/lib/theme/light";
import Api from "@/api";
import Swal from "sweetalert2/dist/sweetalert2.js";
import store from "../store";

export default {
  message(titulo = "", texto, tipoIcone = "success", color = "#008A5E") {
    Swal.fire({
      position: "center",
      icon: tipoIcone,
      title: titulo,
      text: texto,
      showConfirmButton: true,
      confirmButtonColor: color,
      // timer: 1500,
    });
  },
  messageToast(titulo = "", tipoIcone = "success", position = "top-end") {
    Swal.fire({
      toast: true,
      title: titulo,
      icon: tipoIcone,
      position: position,
      showConfirmButton: false,
      timer: 6000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
      },
    });
  },
 async  messageNotificacao() {
    const Toast = Swal.mixin({
      toast: true,
      position: "top-right",
      iconColor: "white",
      customClass: {
        popup: "colored-toast",
      },
      showConfirmButton: false,
      timer: 4000,
      timerProgressBar: true,
    });
    await Toast.fire({
      icon: "info",
      title: "Nova Solicitação de Autorização.",
      didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
      },
    });
  },

  messageDelete(id, baseUrl, pathRoute, nameToExclude) {
    Swal.fire({
      title: `Tem certeza que deseja apagar <b>${`${nameToExclude}`}</b>?`,
      text: "Esta ação não poderá ser desfeita!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#ff0000",
      confirmButtonText: "Excluir",
      cancelButtonText: "Cancelar",
    }).then(async (result) => {
      if (result.isConfirmed) {
        const response = await Api.delete(`${baseUrl}${pathRoute}`, id);
        if (!response) return false;
        Swal.fire({
          title: response.data.success,
          icon: "success",
        });
        store.dispatch("$_reloadIndex/reloadIndex", true);
      }
    });
  },

  messageComBtnsDeConfimacao(
    title,
    text = "",
    icon = "success",
    confirmButtonText = "Sim",
    cancelButtonText = "Não",
    denyButtonText = "",
    showDenyButton = false
  ) {
    return Swal.fire({
      title: title,
      text: text,
      icon: icon,
      showCancelButton: true,
      showDenyButton: showDenyButton,
      confirmButtonColor: "#4caf50",
      denyButtonColor: '#468bd9',
      confirmButtonText: confirmButtonText,
      cancelButtonText: cancelButtonText,
      denyButtonText: denyButtonText,
    });
  },

  deleteMessage(nameToExclude) {
   return Swal.fire({
      title: `Tem certeza que deseja apagar <b>${`${nameToExclude}`}</b>?`,
      text: "Esta ação não poderá ser desfeita!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#ff0000",
      confirmButtonText: "Excluir",
      cancelButtonText: "Cancelar",
    })
  },
};

// Swal.message("testou", "teste com sucesso");

