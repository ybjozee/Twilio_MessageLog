<Modal
        danger
        preventCloseOnClickOutside
        bind:open={modalIsOpen}
        modalHeading="Delete all instances"
        primaryButtonText="Delete"
        secondaryButtonText="Cancel"
        on:click:button--secondary={closeModal}
        on:click:button--primary={handleDelete}
        on:open
        on:close
        on:submit
>
    <p>This is a permanent action and cannot be undone.</p>
</Modal>

{#if showAsIcon}
    <Button
            kind="danger-tertiary"
            on:click={openModal}
            iconDescription="Delete"
            icon={TrashCan}
            size="small"
    />
{:else }
    <div class="centered">
        <Button
                kind="danger-tertiary"
                on:click={openModal}
        >
            Delete Message
        </Button>
    </div>
{/if}

{#if displayLoading}
    <Loading kind="danger"/>
{/if}

<style>
    .centered {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1%;
    }
</style>

<script>
    import {Button, Loading, Modal} from "carbon-components-svelte";
    import TrashCan from "carbon-icons-svelte/lib/TrashCan.svelte";
    import {createEventDispatcher} from "svelte";
    import {deleteMessage} from "../Api";

    const dispatch = createEventDispatcher();

    export let messageSid;
    export let showAsIcon;

    let modalIsOpen = false;
    let displayLoading = false;

    const openModal = () => {
        modalIsOpen = true;
    }

    const closeModal = () => {
        modalIsOpen = false;
    }

    const handleDelete = async () => {
        closeModal();
        displayLoading = true;
        await deleteMessage(messageSid);
        dispatch("delete", {messageSid});
        displayLoading = false;
    }
</script>