import { toast } from "vue3-toastify";

export const ToastService = {
  showError(message = "Hiba a szinkronizálás során!", duration = 5000) {
    return toast.error(message, {
      autoClose: duration,
      icon: "❌",
      position: "top-right",
    });
  },

  showSuccess(
    message = "Szinkronizálás sikeresen végrehajtva!",
    duration = 3000
  ) {
    return toast.success(message, {
      autoClose: duration,
      icon: "✅",
      position: "top-right",
    });
  },

  showConfirm(
    title = "Megerősítés",
    message = "Biztosan folytatni szeretnéd?",
    confirmText = "Igen",
    cancelText = "Mégse"
  ) {
    return new Promise((resolve) => {
      const confirmId = toast(message, {
        position: "top-center",
        autoClose: false,
        closeOnClick: false,
        draggable: false,
        hideProgressBar: true,
        closeButton: false,
        type: "warning",
        icon: "⚠️",
        onClose: () => resolve(false),
      });

      setTimeout(() => {
        const toastEl = document.querySelector(".Toastify__toast:last-child");
        if (toastEl) {
          const iconEl = toastEl.querySelector(".Toastify__toast-icon");
          iconEl.style.cssText = "font-size: 3em; margin-right: 8px;";

          const toastBody = toastEl.querySelector(".Toastify__toast-body");
          toastBody.style.cssText =
            "display: flex; flex-direction: column; align-items: center; text-align:center;";

          const messageDiv = toastBody.querySelector("div");
          messageDiv.style.cssText =
            "color: #333; font-weight: normal; text-align: center; padding: 0 5px; margin-bottom: 16px;";

          const buttonsDiv = document.createElement("div");
          buttonsDiv.style.cssText =
            "display: flex; gap: 12px; justify-content: center; margin-top: 1rem;";

          const cancelBtn = document.createElement("button");
          cancelBtn.textContent = cancelText;
          cancelBtn.style.cssText =
            "padding: 8px 16px; border: none; border-radius: 6px; background: #6c757d; color: white; cursor: pointer; font-weight: 600;";
          cancelBtn.onclick = () => {
            resolve(false);
            toastEl.remove();
          };

          const confirmBtn = document.createElement("button");
          confirmBtn.textContent = confirmText;
          confirmBtn.style.cssText =
            "padding: 8px 16px; border: none; border-radius: 6px; background: #28a745; color: white; cursor: pointer; font-weight: 600;";
          confirmBtn.onclick = () => {
            resolve(true);
            toastEl.remove();
          };

          buttonsDiv.appendChild(cancelBtn);
          buttonsDiv.appendChild(confirmBtn);
          toastBody.appendChild(buttonsDiv);
        }
      }, 50);
    });
  },

  showLoading(message = "Betöltés folyamatban...") {
    return toast.loading(message, {
      position: "top-right",
      autoClose: false,
      closeOnClick: false,
      draggable: false,
      type: toast.TYPE.INFO,
    });
  },
  updateToast(toastId, options) {
    toast.update(toastId, options);
  },

  updateToSuccess(toastId, message = "Sikeres művelet!") {
    toast.update(toastId, {
      render: message,
      type: toast.TYPE.SUCCESS,
      icon: "✅",
      autoClose: 3000,
      isLoading: false,
    });
  },

  updateToError(toastId, message = "Hiba történt!") {
    toast.update(toastId, {
      render: message,
      type: toast.TYPE.ERROR,
      icon: "❌",
      autoClose: 5000,
      isLoading: false,
    });
  },

  dismiss(toastId) {
    toast.dismiss(toastId);
  },
};
export const useToast = () => {
  const showLoadingToast = (message = "Betöltés folyamatban...") => {
    return ToastService.showLoading(message);
  };

  const updateToSuccess = (toastId, message = "Sikeres művelet!") => {
    ToastService.updateToSuccess(toastId, message);
  };

  const updateToError = (toastId, message = "Hiba történt!") => {
    ToastService.updateToError(toastId, message);
  };

  return {
    showLoadingToast,
    updateToSuccess,
    updateToError,
  };
};
