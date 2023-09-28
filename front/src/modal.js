

import { ref } from 'vue';


export const modalStates = ref(false);


export const toggleModal = () => {
  modalStates.value = !modalStates.value;
};