<template>
    <!-- @Todo: Michel : Wenn End und Begin date gleich, Anders rendern -->
    <div class="fill-parent d-flex fd-column">
        <!-- Header -->
        <div class="box-auto d-flex">
            <div class="box-auto">
                <h1 class="m-r-lg">Bericht</h1>
                <div class="b-b-thin"></div>
            </div>
            <div class="box d-flex jc-end ai-center">
                <a :href="downloadRoute">
                    <i class="nav-i material-icons font-md color-1">arrow_downward</i>
                </a>
                <i class="nav-i material-icons font-xl color-1"
                   @click="navBack()"
                >keyboard_arrow_left</i>
            </div>
        </div>
        <!-- Navigation Tree -->
        <div v-if="$tree.reportBook !== undefined" class="m-b-lg d-flex nav-tree-wrapper">
            <div class="box-auto d-flex f-center">
                <h2 @click="$router.push({name: 'reportBooks'});" class="no-select font-sm lbl-light">{{$user.username}}</h2>
            </div>
            <div class="box-auto d-flex f-center">
                <i class="material-icons">keyboard_arrow_right</i>
            </div>
            <div @click="navBack()" class="box-auto d-flex f-center">
                <h2 class="no-select font-sm lbl-light">{{$tree.reportBook.name}}</h2>
            </div>
            <div class="box-auto d-flex f-center">
                <i class="material-icons">keyboard_arrow_right</i>
            </div>
            <div class="box-auto d-flex f-center">
                <h2 class="no-hov no-select font-sm lbl-light">
                    Nr. {{report.position}}
                    ({{new Date(report.begin_date).toLocaleDateString('de', {dateStyle: 'medium'})}}
                    - {{new Date(report.end_date).toLocaleDateString('de', {dateStyle: 'medium'})}})</h2>
            </div>
        </div>
        <div class="box d-flex jc-center">
            <div class="w-xx p-md d-flex fd-column">
                <!-- Report Header -->
                <div class="d-flex box-auto m-b-lg">
                    <div class="box">
                        <h2 class="font-md lbl-light">
                            Bericht Nr. {{this.report.position}}
                            vom {{new Date(this.report.begin_date).toLocaleDateString("de",{dateStyle: 'medium'})}}
                            bis zum {{new Date(this.report.end_date).toLocaleDateString("de",{dateStyle: 'medium'})}}
                        </h2>
                        <div class="b-b-thin"></div>
                        <div class="d-flex">
                            <h3 class="font-sm lbl-light m-r-sm">Auszubildender: {{this.$user.username}},</h3>
                            <h3 class="font-sm lbl-light m-r-sm">Abteilung: {{this.report.department}},</h3>
                            <h3 class="font-sm lbl-light">Unternehmen: {{this.report.company}}</h3>
                        </div>
                    </div>
                </div>
                <div class="box of-y-auto hide-scrollbar">
                    <!-- Actual Entries -->
                    <h2 v-if="Object.keys(company_entries).length !== 0" class="font-sm lbl-light">Betriebliche Tätigkeiten</h2>
                    <transition-group name="list">
                        <div v-for="item in company_entries" :key="item.id">
                            <entry @updated="fetchEntries()"
                                   class="m-b-md"
                                   :entry="item"
                                   :report_id="$route.params.report.id"
                                   :header="item.header"
                                   :description="item.description"></entry>
                        </div>
                    </transition-group>
                    <h2 v-if="Object.keys(school_entries).length !== 0" 
                    class="no-select font-sm lbl-light">Schulische Tätigkeiten</h2>
                    <transition-group name="list">
                        <div v-for="item in school_entries" :key="item.id">
                            <entry @updated="fetchEntries()"
                                   class="m-b-md"
                                   :entry="item"
                                   :report_id="$route.params.report.id"
                                   :header="item.header"
                                   :description="item.description"></entry>
                        </div>
                    </transition-group>
                    <div v-if="this.duration_sum > 0" 
                        class="no-select d-flex jc-end m-b-md">
                        <h2 class="font-sm lbl-light">
                            {{this.duration_sum}} Std. gesamt
                        </h2>
                    </div>
                    <!-- Add Entry Form -->
                    <transition name="fade">
                        <create-entry
                                v-if="showForm"
                                :entry="null"
                                @entryAdded="fetchEntries()"
                                @cancel="showForm = false"
                                :report_id="report.id">
                        </create-entry>

                        <!-- Add Entry Button -->
                        <div ref="btn_add_entry"
                             tabindex="0"
                             class="entry"
                             @keydown.enter="showForm = true"
                             @click="showForm = true"
                             v-if="!showForm"
                        >
                            <div class="d-flex b-thin f-center p-md">
                                <i class="material-icons font-lg color-1">add</i>
                            </div>
                        </div>
                    </transition>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    import entry from './entry.vue';
    import createEntry from './createEntry.vue';

    export default {
        data() {
            return {
                entries: [],
                company_entries: [],
                school_entries: [],
                report: {},
                showForm: false,          
                downloadRoute: '/download/reportpdf/',
            }
        },
        components: {
            entry,
            createEntry
        },
        computed:{
            duration_sum(){
                var sum = 0;
                for(var item in this.entries){                    
                    sum += this.entries[item].duration;
                }
                return sum;
            }
        },
        mounted() {
            if (this.$route.params.report === undefined) {
                this.$router.push({name: 'reportBooks'});
                return;
            }
            console.log(this.$route.params.report);
            this.report = this.$route.params.report;
            this.fetchEntries();
            this.downloadRoute += '' + this.$route.params.report.id;
        },
        methods: {
            fetchEntries() {
                axios.post('/entries/get', {reportId: this.$route.params.report.id})
                    .then((response) => {
                        this.entries = response.data.data;
                        this.showForm = false;
                        this.school_entries = this.filterEntries('school');
                        this.company_entries = this.filterEntries('company');
                        this.$nextTick(() => {
                            this.$refs.btn_add_entry.focus();
                        })
                    }, (error) => {
                        console.log(error);
                    });
            },
            filterEntries(pType) {
                var result = {};
                for (var item in this.entries) {
                    if (this.entries[item].type == pType) {
                        result[item] = this.entries[item];
                    }
                }
                return result;
            },
            navBack() {
                this.$router.push({name: 'reports', params: {report_book_id: this.$route.params.report_book_id}})
            },
        }
    }
</script>
<style scoped>
    .border {
        border: 1px solid black
    }

    div[tabindex] {
        outline: none;
    }

    .entry {
        background-color: transparent;
        transition: background-color .07s ease;
    }

    .entry:hover, .entry:focus {
        background-color: var(--c-third);
    }

    .entry:hover i, .entry:focus i {
        color: var(--c-second)
    }


    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s;
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */
    {
        opacity: 0;
    }
</style>