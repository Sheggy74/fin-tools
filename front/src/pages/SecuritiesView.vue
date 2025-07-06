<template>
  <v-container fluid>
    <v-row class="align-center">
        <div class="d-flex flex-row w-100">
                <v-text-field
                    v-model="searchString"
                    label="Поиск"
                    hide-details
                    variant="outlined"
                    dense
                    class="flex-grow-1"
                >
                    <template v-slot:append>
                        <v-btn
                            color="primary"
                            small
                            @click="onSearch()"
                            style="min-height: 55px;"
                        >
                            <v-icon small>mdi-magnify</v-icon>
                            Найти
                        </v-btn>
                    </template>
                </v-text-field>
            </div>
    </v-row>
    <v-row>
        <v-col cols="12">
           <v-card class="fill-height">
             <v-data-table 
                height="1000px"
                :headers="headers"
                :items="data"
                :loading="loading"
            >
                <template v-slot:no-data>
                    Нет данных для отображения.
                </template>
                <template v-slot:item.name="{item}">
                    <td>
                        <div class="d-flex flex-column">
                            <strong>{{ item.shortName }}</strong>
                            <small class="text-yellow">{{ item.name }}</small>
                        </div>
                    </td>
                </template>
                <template v-slot:item.type="{item}">
                    <td>
                            <div class="text-red">
                                {{ item.type }}
                            </div>
                        </td>
                </template>
 
            </v-data-table>
           </v-card>
        </v-col>            
    </v-row>
    
  </v-container>
</template>

<script setup>
import {ref, onMounted} from 'vue'
import axios from "axios";

const data = ref([])
const loading = ref(false)
const error = ref(null)
const url = 'http://localhost:8000/security'
const searchString = ref('');
const headers = [
    {title: 'Идентификатор', key: 'id'},
    {title: 'Название', key: 'name'},
    {title: 'Эмитент', key: 'emitentName'},
    {title: 'Тип', key: 'type'},
]

const onSearch = async function(){
    try {       
        loading.value = true; 
        const res = await axios.get(url + '?query=' + searchString.value)
        data.value = res?.data?.data ?? []        
    } catch (err) {
        error.value = err.message
    } finally {
        loading.value = false
    }
}

onMounted(async () => {
    
})


</script>
