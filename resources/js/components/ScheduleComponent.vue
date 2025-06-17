<template>
    <div>
        <div class="form-group form-row" v-for="(schedule, index) in schedules">
            <div class="col-11">
                <input
                    class="form-control"
                    type="text"
                    :name="`schedules[${index}][hour]`"
                    v-model="schedule.hour"
                    placeholder="Hour (Exempale = 20:00)"
                />
            </div>
            <div class="col-1">
                <button
                    type="button"
                    class="btn btn-outline-danger"
                    @click="removeSchedule(index)"
                >
                    x
                </button>
            </div>
        </div>
        <div class="text-center">
            <button
                type="button"
                class="btn btn-secondary"
                @click="addSchedule"
            >
                Add Schedule
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        schedules: [],
    }),
    props: ["oldSchedules"],
    created() {
        this.schedules = this.oldSchedules;
    },
    methods: {
        addSchedule() {
            this.schedules.push({
                hour: "",
            });
        },
        removeSchedule(index) {
            this.schedules.splice(index, 1);
        },
    },
};
</script>
