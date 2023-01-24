<template>
    <v-form v-model="valid" ref="form">
        <v-container>
            <v-row>
                <v-col
                    cols="12"
                    md="4"
                >
                    <v-text-field
                        v-model="userModel.fullName"
                        :rules="userModelRules.fullName"
                        label="Full name"
                        required
                    ></v-text-field>
                </v-col>

                <v-col
                    cols="12"
                    md="4"
                >
                    <v-autocomplete
                        v-model="userModel.country"
                        :items="countriesSelect"
                        :rules="userModelRules.country"
                        return-object
                        item-text="flagAndName"
                        label="Countries"
                        required
                    >
                        <template v-slot:item="{ item, attrs, on }">
                            <v-list-item
                                v-bind="attrs"
                                v-on="on"
                            >
                                <v-list-item-content>
                                    <v-list-item-title
                                        :id="attrs['aria-labelledby']"
                                        v-text="item.flagAndName"
                                    ></v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </template>
                    </v-autocomplete>
                </v-col>

                <v-col
                    cols="12"
                    md="4"
                >
                    <v-text-field
                        v-model="userModel.phone"
                        :prefix="idd"
                        :rules="userModelRules.phone"
                        :disabled="!userModel.country"
                        label="Phone number"
                        v-mask="'## ###-##-##'"
                        return-masked-value
                        validate-on-blur
                        required
                    ></v-text-field>
                </v-col>

                <v-col
                    cols="12"
                    md="4"
                >
                    <v-text-field
                        v-model="userModel.email"
                        :rules="userModelRules.email"
                        label="E-mail"
                        required
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-btn
                elevation="2"
                @click="sendForm"
            >Send form
            </v-btn>
        </v-container>
        <template v-if="serverMessage">
            {{ serverMessage }}
        </template>
    </v-form>
</template>

<script>
import countries from '@/data/countries.json'
import axios from 'axios'

export default {
    name: "CreateUserForm",
    components: {},
    data: () => ({
        countries: countries,
        serverMessage: null,
        valid: false,
        userModel: {
            fullName: null,
            country: null,
            phone: '',
            email: null,
        },
        userModelRules: {
            fullName: [
                v => !!v || 'Full name is required',
            ],
            country: [
                v => !!v || 'Country is required',
            ],
            phone: [
                v => !!v || 'Phone is required',
                v => /[0-9]+\s[0-9]{3}-[0-9]{2}-[0-9]{2}$/.test(v) || 'Phone format is not valid',
            ],
            email: [
                v => !!v || 'E-mail is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid',
            ],
        },
    }),
    methods: {
        sendForm() {
            this.$refs.form.validate()
            if (this.valid) {
                axios.post('http://localhost:8000/api/users',
                    this.formData)
                    .then(response => (this.serverMessage = response))
                    .catch(e => (this.serverMessage = e.response.data.errors))
            }
        }
    },
    computed: {
        countriesSelect() {
            return this.countries.map(i =>
                Object.assign(i,
                    {
                        id: this.countries.indexOf(i),
                        flagAndName: i.flag + ' ' + i.name
                    })
            ).filter(i => i.name)
        },
        idd() {
            return this.userModel.country ? this.userModel.country.idd : ""
        },
        fullPhone() {
            return this.idd + ' ' + this.userModel.phone
        },
        formData() {
            if (this.valid) {
                return {
                    fullName: this.userModel.fullName,
                    country: this.userModel.country.name,
                    phone: this.fullPhone,
                    email: this.userModel.email,
                }
            }

            return null
        }
    }
}

</script>

<style scoped>

</style>
